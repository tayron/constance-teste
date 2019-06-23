@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <h1>Usuários</h1>
        
        @include('elements.message_success_error')
        
        <a href="{{url('/usuario/novo/')}}" class="btn btn-sm btn-success float-right">Novo usuário</a>
        <br /><br /><br />
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th>Photo</th>
                        <th>Nome</th>
                        <th>Ocupação</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th style="width: 10%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listUsers as $user)
                    <tr>
                        <td>{{$user->id}}</td>  
                        <td>
                            <img src="{{url("storage/upload/img/users/{$user->photo}")}}" alt="{{$user->name}}" class="img img-fluid" />
                        </td>                        
                        <td>{{$user->name}}</td>                                                            
                        <td>{{$user->occupation}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td class="actions">
                            <div class="btn-group">
                                <a href="{{url('/usuario/editar/' . $user->id)}}" class="btn btn-info btn-sm" title="Editar">
                                    Editar
                                </a>
                                <form name="post_{{$user->id}}" style="display:none;" method="post" action="{{url('/usuario/excluir/')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                </form>
                                
                                <a href="#" class="btn btn-danger btn-sm" title="Excluir" onclick="if (confirm('Tem certeza que deseja excluir o registro # {{$user->id}}?')) {
                                        document.post_{{$user->id}}.submit();
                                            }
                                            event.returnValue = false;
                                            return false;">
                                    Apagar
                                </a>
                            </div>                                
                        </td>                                        
                    </tr>
                    @endforeach
                </tbody>
            </table>                    
            {{ $listUsers->links() }}
        </div>
    </div>
</div>
<!-- GET IT-->
@endsection
