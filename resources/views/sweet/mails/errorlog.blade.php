<h3>Error Log Informtion from laravel website:</h3>
<strong>Date:</strong> {{ date('M d, Y H:iA') }}

<strong>Message:</strong> {{ $e->getMessage() }}

<strong>Code:</strong> {{ $e->getCode() }}

<strong>File:</strong> {{ $e->getFile() }}

<strong>Line:</strong> {{ $e->getLine() }}