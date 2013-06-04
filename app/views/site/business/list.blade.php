  <table class="table table-hover">
      <thead>
          <tr>
              <th class="span5"></th>
              <th class="span5"></th>
              <th class="span5"></th>
          </tr>
      </thead>
      <tbody>
      @if(isset($businesses))
      @foreach ($businesses as $business)

              @if(Confide::user())
              @foreach(Confide::user()->contacts() as $contact)
                @if($contact->business->contains($business->id))
                  adherido
                @endif
              @endforeach
              @endif
              <td>{{ $business->name }}</td>
              <td>{{ $business->description }}</td>
              <td>
                  <a href="{{{ URL::to($business->slug) }}}" class="btn btn-primary">{{{ trans('button.enter') }}}</a>
                  {{ Button::success_link(URL::to($business->slug), trans('button.about')) }}
              </td>
          </tr>
      @endforeach
      @endif
      </tbody>
  </table>