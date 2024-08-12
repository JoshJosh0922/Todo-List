<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- CSS -->
        <link href="{{asset('css/modal.css')}}" rel="stylesheet" />

        <!-- Tailwind Style -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />

        <!-- Icon -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"></script>

        <style>
            body{
                font-family: 'Nunito', sans-serif;
            }

        </style>
    </head>
    <body>
        <div class="bg-gray-200 p-4">
            <div class="lg:w-2/4 mx-auto py-8 px-6 bg-white rounded-xl">
                <h1 class="font-bold text-5xl text-center mb-8">To do list</h1>
                <div class="mb-6">
                    <form action="/{{ isset($Selected) ? $Selected->id : '' }}" method="POST" class="flex flex-col space-y-4">
                        @csrf
                        @if(isset($Selected) && $Selected->id)
                            @method('PUT')
                        @endif
                        <input value="{{isset($Selected) ?  $Selected->title : ""}}" type="text" name="title" placeholder="The todo title" class="py-3 px-4 bg-gray-100 rounded-xl">
                        <textarea name="description" placeholder="The todo description" class="py-3 px-4 bg-gray-100 rounded-xl">{{ isset($Selected) ? $Selected->description : '' }}</textarea>
                        <div class="flex justify-between items-center space-x-4">
                            <div class="flex-row">
                                <button class="w-28 py-2 px-6 bg-green-500 text-white rounded-xl">{{ isset($Selected->id) ? "Update": "Add" }}</button>
                                @if (isset($Selected->id))
                                    <a href="/" class="w-28 py-3 px-8 bg-red-500 text-white rounded-xl text-center">Cancel</a>
                                @endif
                            </div>
                            <a class="w-auto py-2 px-2 bg-blue-500 text-white rounded-xl text-center" id="myBtn">
                                <i class='bx bx-printer text-xl'></i>
                            </a>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="mt-2">
                    @foreach ($Hamborger['todos'] as $todo)
                        <div 
                        @class([
                            "py-4 flex item-center border-b border-gray-300 px-3",
                            $todo->isDone ? "bg-green-200":""
                        ])
                        >
                            <div class="flex-1 pr-8">
                                <h3 class="text-lg font-semibold">{{ $todo->title }}</h3>
                                <p class="text-gray-500">{{ $todo->description }}</p>
                            </div>
                            <div class="flex space-x-3">
                               <form method="POST" action="/{{$todo->id}}">
                                    @csrf
                                    @method("PATCH")
                                    @if (!$todo->isDone)
                                        <button class="py-2 px-2 bg-green-500 text-white rounded-xl h-10 w-10">
                                            <i class='bx bx-check text-xl'></i>
                                        </button>
                                    @endif
                               </form>
                               <form method="POST" action="/{{$todo->id}}">
                                    @csrf
                                    @method("POST")
                                    @if (!$todo->isDone)
                                        <button class="py-2 px-2 bg-blue-500 text-white rounded-xl h-10 w-10">
                                            <i class='bx bx-edit-alt text-xl' ></i>
                                        </button>
                                    @endif
                               </form>
                               <form method="POST" action="/{{$todo->id}}">
                                    @csrf
                                    @method("DELETE")
                                    <button class="py-2 px-2 bg-red-500 text-white rounded-xl h-10 w-10">
                                        <i class='bx bxs-trash text-xl' ></i>
                                    </button>
                               </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="content-container">
                <div class="heade_container">
                    <span class="close">&times;</span>
                </div>
                <div class="body_container">
                    <h1>Todo List Report</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>isDone</th>
                                <th>Created Date</th>
                                <th>Edited Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Hamborger['todos'] as $todo)
                                <tr>
                                    <td>{{$todo->id}}</td>
                                    <td>{{$todo->title}}</td>
                                    <td>{{$todo->description}}</td>
                                    <td><div class="{{$todo->isDone ? "isDone_indicator" : "isNotDone_indicator"}}"></div></td>
                                    <td>{{$todo->created_at}}</td>
                                    <td>{{$todo->updated_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-1">
                    <button class="w-10 py-2 bg-blue-500 text-white rounded-xl" id="btnPrint" ><i class='bx bx-printer text-xl'></i></button>      
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{asset("js/moda.js")}}" ></script>
        <script>
        document.addEventListener("DOMContentLoaded", () => {
            const BtnPrint = document.getElementById("btnPrint");
            if (BtnPrint) {
                BtnPrint.addEventListener("click", () => {
                    console.log("Click");
                    $(document).ready(function(){
                        $(".body_container").print();
                    });
                });
            }
        });
    </script>
    </body>
</html>
