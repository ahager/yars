@if(isset($contact))
      @foreach($contact->channels as $channel)
		{{ Former::populateField('channel_value', $channel->value) }}
		<div class="row">
		<div class="span3">{{ Former::text('channel_type[]', trans('admin/contacts/contacts.channel.type'), $channel->type)->readonly() }}</div>
		<div class="span3">{{ Former::text('channel_value[]', trans('admin/contacts/contacts.channel.value'), $channel->value) }}</div>
		<div class="span2">{{ Former::text('channel_notes[]', trans('admin/contacts/contacts.channel.notes'), $channel->notes)->placeholder(trans('msg.put_your_annotations')) }}</div>
		</div>
      @endforeach
@endif

<div class="row">
	<div class="span3">
	{{ Former::select('channel_type[]', trans('admin/contacts/contacts.channel.type'))
				->options(
						[	
							'mobile' => trans('app.channel.mobile'),
							'phone' => trans('app.channel.phone'),
							'skype' => trans('app.channel.skype'),
							'facebook' => trans('app.channel.facebook'),
							'twitter' => trans('app.channel.twitter'),
							'email' => trans('app.channel.email'),
						]
							, 'mobile' )
	}}
	</div>
	<div class="span3">{{ Former::text('channel_value[]', trans('admin/contacts/contacts.channel.value')) }}</div>
	<div class="span2">{{ Former::text('channel_notes[]', trans('admin/contacts/contacts.channel.notes')) }}</div>
</div>