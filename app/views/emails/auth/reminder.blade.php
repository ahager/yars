<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ trans('user.password_reset') }}</h2>

		<div>
			{{ trans('user.password_reset_instructions') }} {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>