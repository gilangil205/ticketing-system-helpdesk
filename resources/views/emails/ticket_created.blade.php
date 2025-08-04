<h2>New Ticket Submitted</h2>

<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Topic:</strong> {{ $data['topic'] }}</p>
<p><strong>Title:</strong> {{ $data['title'] }}</p>

<p><strong>Description:</strong></p>
<div>{!! $data['description'] !!}</div>

@if (!empty($data['attachment']))
    <p><strong>Attachment:</strong> {{ $data['attachment'] }}</p>
@else
    <p><strong>Attachment:</strong> No attachment provided.</p>
@endif
