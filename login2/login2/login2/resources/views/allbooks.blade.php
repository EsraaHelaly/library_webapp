<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('the shelf') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="table">
       
        <th>id</th>
        <th>book name</th>
        <th>author name</th>
        <th>edition number</th>
        <th>created at</th>
        <th>updated at</th>
      
        @if(Auth::user()->id !==1)
        <th>borrow this book</th>
        @endif

        @if(Auth::user()->id ==1)
        <th>update</th>
        <th>delete</th>
        @endif

        @foreach ($books as $books)
    <tr>
        <td>{{$books->id}}</td>
        <td>{{$books->bookname}}</td>
        <td>{{$books->authorname}}</td>
        <td>{{$books->editionnumber}}</td>
        <td>{{$books->created_at}}</td>
        <td>{{$books->created_at}}</td>
        
        @if(Auth::user()->id !==1)
        <td><a href="/return/{{$books->id}}" class="btn btn-primary">borrow</a></td>
        @endif
        
        @if(Auth::user()->id ==1)
        <td><a href="/edit/{{$books->id}}" class="btn btn-warning">update</a></td> 
        <td><a href="/delete/{{$books->id}}" class="btn btn-danger">delete</a></td> 
        @endif

    


    </tr>
    @endforeach

        </table>

        @if(Auth::user()->id ==1)
        <td><a href="/add" class="btn btn-primary">add</a></td> 
        @endif
        
        </div>
    </div>
</x-app-layout>
