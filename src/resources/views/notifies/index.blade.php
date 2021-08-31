<html class="no-js" lang="en">
    <head>
        <title>Error Shout - {{ config('app.name') }} </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Error Shout">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 3px 4px;
            }
            .occured-at-th, .occured-at-td {
                width: 110px;
                text-align: center;
            }
            .status-th, .status-td {
                width: 80px;
                text-align: center;
            }
            .line-th, .line-td {
                width: 70px;
                text-align: center;
            }
        </style>

   <thead>
   <body>
       <div class="row">
           <div class="col-md-10 offset-md-1 text-center pt-3">
                <a href="{{ url('/') }}" class="mb-3">Back To Home</a>
           </div>

           <div class="col-md-10 offset-md-1 pt-5 pb-5 table-responsive">
            
            @if( session()->has('success') )
            <div class="alert alert-success text-center" role="alert">
            <h5>{{ session()->get('success') }}</h5>
            </div>
            @elseif( session()->has('error') )
                <div class="alert alert-danger text-center" role="alert">
                <h5>{{ session()->get('error') }}</h5>
                </div>
            @endif

            <form action="">
                <label for="status1">
                    <input type="checkbox" value="unseen" name="status[]" id="status1" 
                    @if(in_array('unseen', request('status',[]) )) checked="checked" @endif /> Unseen
                </label>
                <label for="status2">
                    <input type="checkbox" value="fixed" name="status[]" id="status2" 
                    @if(in_array('fixed', request('status',[]) )) checked="checked" @endif /> Fixed
                </label>
                <input type="submit" value="Search" />
            </form>

            <table class="w-100 mb-3">
            <thead>
                {{-- <th>VerifiedBy/ FixedBy/ NotifiedBy</th> --}}
                <th class="occured-at-th">Occured At</th>
                <th class="status-th">Status</th>
                <th>File</th>
                <th class="line-th">Line</th>
                <th>Message</th>
            </thead>
            <tbody>
                @foreach($notifies as $notify)
                    @php
                       $errData = json_decode($notify->data, true);
                    @endphp
                    <tr>
                        {{-- <td>{{ $notify->verified_by }}/ {{ $notify->fixed_by }}/ {{ $notify->notified_by }}</td> --}}
                            <td class="occured-at-td">{{ $notify->created_at->format('Y-m-d') }}</td>
                            <td class="status-td">
                                {{ $notify->status }} <br/>
                                @if( $notify->status == 'unseen')
                                <a href="{{ route('errorshout.notifies.fix', $notify) }}">Fix</a>
                                @endif
                            </td>
                            <td>{{ $errData['file'] }}</td>
                            <td class="line-td">{{ $errData['line'] }}</td>
                            <td>{{ $errData['msg'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
           {{ $notifies->appends(request()->all())->links() }}
           </div>
       </div>
       
   </body>
</html>