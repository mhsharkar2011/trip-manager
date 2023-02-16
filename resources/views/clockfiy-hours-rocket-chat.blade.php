Hour logs for {{ $date }}

@foreach ($users as $user)
    {{ $user['name'] }} - {{ $user['duration_humazined'] }}
@endforeach

Following users have no entries for {{ $date }}
@foreach ($users_without_entries_arr as $user)
    {{ $user['name'] }}
@endforeach