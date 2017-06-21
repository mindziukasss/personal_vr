<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
{{-- {{dd($menu)}} --}}
        @foreach($menu as $key => $value)
        	
        	
        	{{-- {{dd($value)}} --}}
				
        		<ul>
                    <li>{{$value[0]['name']}}</li>

                </ul>
         
                @endforeach

    </div>
</nav>