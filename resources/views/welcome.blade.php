<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HKS-Assesment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            padding: 50px 100px;
            font-family: sans-serif;
        }

        ul {
            margin: 0;
            padding-left: 25px;
            line-height: 2em;
            list-style: none;
            background-color: #fff;
        }

        ul li {
            position: relative;
        }

        ul li:before {
            position: absolute;
            top: 0;
            left: -15px;
            display: block;
            width: 15px;
            height: 1em;
            content: "";
            border-bottom: 1px dotted #666;
            border-left: 1px dotted #666;
        }

        /* hide the vertical line on the first item */
        ul.tree>li:first-child:before {
            border-left: none;
        }

        ul li:after {
            position: absolute;
            top: 1.1em;
            bottom: 1px;
            left: -15px;
            display: block;
            content: "";
            border-left: 1px dotted #666;
        }

        /* hide the lines on the last item */
        ul li:last-child:after {
            display: none;
        }

        /* inserted via JS  */
        .js-toggle-icon {
            position: relative;
            z-index: 1;
            display: inline-block;
            width: 14px;
            margin-right: 2px;
            margin-left: -23px;
            line-height: 14px;
            text-align: center;
            cursor: pointer;
            background-color: #fff;
            border: 1px solid #666;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>HKS - Assesment</h1>
        
        <ul class="tree">


            @foreach ($roots as $root)
            {{-- <a href="#"> <li></li></a> --}}
            <li onclick="getLebel({{$root->entry_id}})" id="level-{{$root->entry_id}}">
                {{$root->name}}
                <ul>

                </ul>
                
            </li>
                
            @endforeach

            {{-- <li>Hello World</li>

            <li>
                <a href="#">Active Life</a>

                <ul>
                    <li>
                        Disc Golf
                    </li>

                    <li>
                        Diving

                        <ul>
                            <li>
                                Free Diving
                            </li>

                            <li>
                                Scuba Diving
                            </li>
                        </ul>
                    </li>

                    <li>
                        Fishing
                    </li>

                    <li>
                        Fitness &amp; Instruction

                        <ul>
                            <li>
                                Pilates
                            </li>

                            <li>
                                Swimming Lessons/Schools

                                <ul>
                                    <li>
                                        Free Diving
                                    </li>

                                    <li>
                                        Scuba Diving
                                    </li>
                                </ul>
                            </li>

                            <li>
                                Tai Chi (taichi, All)
                            </li>

                            <li>
                                Trainers (healthtrainers, All)
                            </li>

                            <li>
                                Yoga (yoga, All)
                            </li>

                        </ul>
                    </li>

                    <li>
                        Flyboarding (flyboarding, All)
                    </li>

                    <li>
                        Zorbing (zorbing, [NZ, PT])
                    </li>

                </ul>
            </li>

            <li>
                Life

                <ul>
                    <li>
                        Disc Golf
                    </li>

                    <li>
                        Diving

                        <ul>
                            <li>
                                Free Diving
                            </li>

                            <li>
                                Scuba Diving
                            </li>

                        </ul>
                    </li>

                    <li>
                        Fishing
                    </li>

                    <li>
                        Fitness &amp; Instruction

                        <ul>
                            <li>
                                Pilates
                            </li>

                            <li>
                                Swimming Lessons/Schools (swimminglessons, All)
                            </li>

                            <li>
                                Tai Chi (taichi, All)
                            </li>

                            <li>
                                Trainers (healthtrainers, All)
                            </li>

                            <li>
                                Yoga (yoga, All)
                            </li>
                        </ul>
                    </li>

                    <li>
                        Flyboarding (flyboarding, All)
                    </li>

                    <li>
                        Zorbing (zorbing, [NZ, PT])
                    </li>
                </ul>
            </li> --}}

        </ul>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(function() {
            // Hide all lists except the outermost.
            $('ul.tree ul').hide();

            $('.tree li > ul').each(function(i) {
                var $subUl = $(this);
                var $parentLi = $subUl.parent('li');
                var $toggleIcon = '<i class="js-toggle-icon">+</i>';

                $parentLi.addClass('has-children');

                $parentLi.prepend($toggleIcon).find('.js-toggle-icon').on('click', function() {
                    $(this).text($(this).text() == '+' ? '-' : '+');
                    $subUl.slideToggle('fast');
                });
            });
        });
        
        function getLebel(id,name) {
            // console.log('first');
            $.ajax({
            type:'GET',
            url:'lebels/'+id,
            success:function(data) {
                data = JSON.parse(data)
                if(data.length > 0){
                    // <li onclick="getLebel(${id})" id="level-${id}">
                    //  {{$root->name}}
                    var list = '';
                        data.forEach(element => {
                            list +=`<li onclick="getLebel(${element.entry_id})" id="level-${element.entry_id}">
                                ${element.name}
                                <ul></ul>                    
                                </li>`;
                            });
                            
                            
                            $(`#level-${id} > ul`).append(list);
                        }
                    }
                    });
                }
            
                </script>
</body>

</html>
