<html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All students') }}
        </h2>
    </x-slot>

    <head>
        <script>
         function serachUser(){

            let filter=document.getElementById("filter").value.toUpperCase();
            console.log(filter);
            let tableRecord=document.getElementById("tableRecord");
            let tr = tableRecord.getElementsByTagName("tr");
            
            for (var i =0 ;i < tr.length ; i++) {
                let td=tr[i].getElementsByTagName('td')[0];

                if (td) {
                    let txtvalue=td.textContent || td.innerHTML;
                    if (txtvalue.toUpperCase().indexOf(filter)> -1) {
                        tr[i].style.display="";
                    }
                    else{
                        tr[i].style.display="none";
                    }
                }
                
            }


         }
        </script>
    </head>

    <body>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="filter-table">
                    <label>search students by using ID: </label>
                    <input type="text" id="filter" class="filter" placeholder="search by id" onkeyup="serachUser()">
                </div>
                <br>
                <table class="table table-bordered" id="tableRecord">

                    <th>user id</th>
                    <th>user name</th>
                    <th>email number</th>
                    <th>student details</th>


                    @foreach($users as $users)
                    @if($users->id !==1)

                    <tr>
                        <td class="id">{{$users->id}}</td>
                        <td class="name">{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td><a href="/showdetails/{{$users->id}}" class="btn btn-primary">Details</a></td>

                    </tr>
                    @endif

                    @endforeach


                </table>


            </div>
        </div>
    </body>

</x-app-layout>

</html>