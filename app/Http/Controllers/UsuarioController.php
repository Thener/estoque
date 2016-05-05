<?php 

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller {
	
	public function index() {
		return redirect()->action('UsuarioController@pesquisarUsuario');
	}
		
	public function pesquisarUsuario() {
		return view('usuario/pesquisarUsuario');
	}
	
	public function visualizarUsuario($id) {
		return $this->formularioUsuario(User::find($id), true);
	}
	
	public function incluirUsuario() {
		return $this->formularioUsuario(new User(), false);
	}
	
	public function alterarUsuario($id) {
		return $this->formularioUsuario(User::find($id), false);
	}
		
	public function gravarUsuario(UsuarioRequest $request) {
		
		$insert = ($request->input('id') > 0) ? false : true;
		
		$senha = $request->input('senha');
		$confirmaSenha = $request->input('confirmaSenha');
				
		if ($insert) {

			$usuario = new User();
			$usuario->fill($request->all());
						
			if (empty($senha) || empty($confirmaSenha) || $senha != $confirmaSenha) {
				Session::flash('message','Por favor verifique senha e confirmação!');
				return $this->formularioUsuario($usuario, false);
			}			
			$usuario->password = bcrypt($senha);
			$usuario->save();
			$message = 'Usuário(a) ' . $usuario->name . ' criado com sucesso!';
			
		} else {
						
			$usuario = User::find($request->input('id'));
			$usuario->fill($request->all());
			
			if (!empty($senha) && empty($confirmaSenha)) {
				Session::flash('message','Favor informar a confirmação da senha para redefinir a mesma!');
				return $this->formularioUsuario($usuario, false);
			}
			
			if (empty($senha) && !empty($confirmaSenha)) {
				Session::flash('message','Favor informar a senha e confirmação da senha para redefinir a mesma!');
				return $this->formularioUsuario($usuario, false);
			}

			if (!empty($senha) && !empty($confirmaSenha) && $senha != $confirmaSenha) {
				Session::flash('message','Senha e confirmação da senha não conferem!');
				return $this->formularioUsuario($usuario, false);
			}			
			
			if (!empty($senha)) {
				$usuario->password = bcrypt($senha);
			}
			
			$usuario->save();
			$message = 'Usuário(a) ' . $usuario->name . ' alterado com sucesso!';
		}
		return $this->index()->with('message', $message);
	}
	
	public function excluirUsuario($id) {
		$usuario = User::find($id);
		$usuario->delete();
		return $this->index();
	}
	
	public function formularioUsuario($usuario, $somenteLeitura) {
		return view('usuario/formUsuario',[
			'usuario' => $usuario,
			'perfis' => User::perfis(),
			'somenteLeitura' => $somenteLeitura
		]);
	}
	
	public function grid(Request $request) {
		
		$usuarios = User::paginate($request);
		
		$data = array();
		
		$data['page'] 	= $request->input('page');
		$data['total'] 	= User::count();
		$data['rows'] 	= array();
		
		foreach($usuarios as $usuario) {
			$data['rows'][] = array(
					'id' => $usuario->id,
					'cell' => array(
						$usuario->id,
						$usuario->name,
						$usuario->email,
						$usuario->getNomePerfil()
					)
			);
		}
		
		return json_encode($data);		
	}
	
}