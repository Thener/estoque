<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'perfil'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public static function paginate($request) {
    
    	$page 		= $request->input('page');
    	$rp 		= $request->input('rp');
    	$sortname 	= $request->input('sortname');
    	$pesquisa 	= $request->input('query') . '%';
    	$sortorder 	= $request->input('sortorder');
    	$qtype 		= $request->input('qtype');
    	$filtros 	= $request->input('filtros');
    
    	$offset = ($page == 1) ? 0 : ($page-1) * $rp;
    
    	return User::orderBy($sortname, $sortorder)
    		->offset($offset)
    		->limit($rp)
    		->where($qtype, 'ilike', $pesquisa)
    		->get();
    } 

    public static function perfis() {
    	return array(
    		1 => 'Administrador',
    		2 => 'Vendedor'
    	);
    }
    
    public function getNomePerfil() {
    	$perfis = self::perfis();
    	return $perfis[$this->perfil];
    }
}
