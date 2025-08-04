<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Client::query();

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('username', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('full_name', 'like', "%$search%")
                      ->orWhere('alamat', 'like', "%$search%")
                      ->orWhere('nohp', 'like', "%$search%");
                });
            }

            if ($request->has('filter')) {
                $filter = $request->filter;
                if (in_array($filter, ['Active', 'Inactive'])) {
                    $query->where('status', $filter);
                }
            }

            $clients = $query->latest()->paginate(10);

            return view('clients.index', compact('clients'));

        } catch (\Exception $e) {
            Log::error('Client index error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menampilkan data client');
        }
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        Log::info('Client store request data:', $request->all());

        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:clients',
                'password' => ['required', 'confirmed', Password::min(8)],
                'email' => 'required|email|unique:clients',
                'full_name' => 'required|string|max:255',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'alamat' => 'nullable|string',
                'nohp' => 'nullable|string|max:20',
                'status' => 'required|in:Active,Inactive',
            ]);

            $validated['password'] = Hash::make($request->password);

            if ($request->hasFile('picture')) {
                Log::info('Uploading client picture');
                $validated['picture'] = $this->uploadFile($request->file('picture'), 'client_pictures');
            }

            if ($request->hasFile('logo')) {
                Log::info('Uploading client logo');
                $validated['logo'] = $this->uploadFile($request->file('logo'), 'client_logos');
            }

            $client = Client::create($validated);
            Log::info('Client created successfully with ID: ' . $client->id);

            // Sinkronisasi ke tabel users
            User::create([
                'full_name' => $validated['full_name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => $validated['password'], // sudah di-hash
                'role' => 'Client',
                'email_verified_at' => now(),
            ]);

            return redirect()->route('clients.index')
                ->with('success', 'Client created successfully and can now log in.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Client store error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Client $client)
    {
        try {
            return view('clients.show', compact('client'));
        } catch (\Exception $e) {
            Log::error('Client show error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menampilkan detail client');
        }
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        Log::info('Client update request data for ID ' . $client->id . ':', $request->all());

        try {
            $rules = [
                'username' => 'required|string|max:255|unique:clients,username,'.$client->id,
                'email' => 'required|email|unique:clients,email,'.$client->id,
                'full_name' => 'required|string|max:255',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'alamat' => 'nullable|string',
                'nohp' => 'nullable|string|max:20',
                'status' => 'required|in:Active,Inactive',
            ];

            if ($request->filled('password')) {
                $rules['password'] = ['confirmed', Password::min(8)];
            }

            $validated = $request->validate($rules);

            if ($request->filled('password')) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']);
            }

            if ($request->hasFile('picture')) {
                $this->deleteFile($client->picture);
                $validated['picture'] = $this->uploadFile($request->file('picture'), 'client_pictures');
            } elseif ($request->has('remove_picture')) {
                $this->deleteFile($client->picture);
                $validated['picture'] = null;
            }

            if ($request->hasFile('logo')) {
                $this->deleteFile($client->logo);
                $validated['logo'] = $this->uploadFile($request->file('logo'), 'client_logos');
            } elseif ($request->has('remove_logo')) {
                $this->deleteFile($client->logo);
                $validated['logo'] = null;
            }

            $client->update($validated);
            Log::info('Client ID ' . $client->id . ' updated successfully');

            return redirect()->route('clients.index')
                ->with('success', 'Client updated successfully.');

        } catch (\Exception $e) {
            Log::error('Client update error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Client $client)
    {
        try {
            $this->deleteFile($client->picture);
            $this->deleteFile($client->logo);

            $client->delete();
            Log::info('Client ID ' . $client->id . ' deleted successfully');

            return redirect()->route('clients.index')
                ->with('success', 'Client deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Client delete error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus client');
        }
    }

    public function toggleStatus(Client $client)
    {
        try {
            $client->status = $client->status === 'Active' ? 'Inactive' : 'Active';
            $client->save();

            Log::info('Client ID ' . $client->id . ' status toggled to ' . $client->status);

            return back()->with('success', 'Client status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Toggle status error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengubah status');
        }
    }

    private function uploadFile($file, $directory)
    {
        try {
            if (!$file->isValid()) {
                throw new \Exception('File upload tidak valid');
            }

            $path = $file->store($directory, 'public');
            Log::info('File uploaded to: ' . $path);

            return $path;

        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function deleteFile($path)
    {
        try {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                Log::info('File deleted: ' . $path);
            }
        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage());
        }
    }
}
