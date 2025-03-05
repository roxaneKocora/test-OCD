
<x-app-layout>
    @if(Session::has('success'))
    <div  class="alert alert-success" role="alert" >
        <strong>{{Session::get('success')}}</strong>
    </div>
    @endif

    @if(Session::has('error'))
    <div  class="alert alert-danger" role="alert" >
        <strong>{{Session::get('error')}}</strong>
    </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <b>Infos de la personne</b>
            <div class="mt-2 mb-4">
                <div>
                    <i class="text-primary">Nom :</i> {{$people->last_name}}
                </div>
                <div>
                    <i class="text-primary" >Prénom :</i> {{$people->first_name}}
                </div>
                <div>
                    <i class="text-primary" >Autres :</i> {{$people->middle_names}}
                </div>
                <div>
                    <i class="text-primary" >Nom d'annif :</i> {{$people->birth_name}}
                </div>
                <div>
                    <i class="text-primary" >Anniversaire :</i> {{$people->date_of_birth}}
                </div>
                <div>
                    <i class="text-primary" >Nom :</i> {{$people->first_name}} {{$people->last_name}}
                </div>
            </div>


            <b class="mt-2" >Degre</b>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-lg-12"> <h4 class="text-primary" >Les parents</h4> </div>
                <div class="col-lg-12">
                    <div  class="table-responsive" >
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nom & Prénoms</th>
                                    <th scope="col">Date d'anniversaire</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($people->parents as $parent)
                                <tr>
                                    <td>{{$parent->first_name}} {{$parent->last_name}}</td>
                                    <td>{{$parent->date_of_birth}}</td>
                                    <td><a href="{{route('show_people',encrypt($parent->id))}}">Voir</a></td>
                                    @if(Auth::check())
                                    <td>
                                        <a class="btn btn-primary" href="Javascript:void(0)" data-toggle="modal" data-target="#parentModal{{$loop->iteration}}">
                                            Modifier relation
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12"> <h4 class="text-primary" >Les enfants</h4> </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table" id="myTable2" >
                            <thead>
                                <tr>
                                    <th scope="col">Nom & Prénoms</th>
                                    <th scope="col">Date d'anniversaire</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($people->enfants as $enfant)
                                <tr>
                                    <td>{{$enfant->first_name}} {{$enfant->last_name}}</td>
                                    <td>{{$enfant->date_of_birth}}</td>
                                    <td><a href="{{route('show_people',encrypt($enfant->id))}}">Voir</a></td>

                                    @if(Auth::check())
                                    <td>
                                        <a class="btn btn-primary" href="Javascript:void(0)" data-toggle="modal" data-target="#childModal{{$loop->iteration}}">
                                            Modifier relation
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    @if(Auth::check())
        @foreach ($people->enfants as $enfant)
        <div class="modal fade" id="childModal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="childModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="childModalLabel">Modifier relation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Entre <span class="text-primary">{{$people->first_name}} {{$people->last_name}}</span> et
                <span class="text-sucess">{{$enfant->first_name}} {{$enfant->last_name}} </span>, il n'y a pas une relation
                <b> <span class="text-primary">PARENT</span> - <span class="text-success">ENFANT</span></b> mais plutot <span class="text-danger">Enfant - Parent</span> .
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <a href="{{route('edit_relation',[$people->id , $enfant->id , 'child' ])}}" class="btn btn-primary">Demander le changement</a>
                </div>
            </div>
            </div>
        </div>
        @endforeach

        @foreach ($people->parents as $parent)
        <div class="modal fade" id="parentModal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="parentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="parentModalLabel">Modifier relation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Entre <span class="text-primary">{{$people->first_name}} {{$people->last_name}}</span> et
                <span class="text-sucess">{{$parent->first_name}} {{$parent->last_name}} </span>, il n'y a pas une relation
                <b> <span class="text-primary">ENFANT</span> - <span class="text-success">PARENT</span></b> mais plutot <span class="text-danger">Parent - Enfant</span> .
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <a href="{{route('edit_relation',[$people->id , $parent->id , 'parent' ])}}" class="btn btn-primary">Demander le changement</a>
                </div>
            </div>
            </div>
        </div>
        @endforeach
    @endif


    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $('#myTable2').DataTable();
        });
    </script>
    @endpush

</x-app-layout>
