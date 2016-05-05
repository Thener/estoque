<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Banco;
use App\Models\Produto;
use App\User;

class DatabaseSeeder extends Seeder {
	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CategoriaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(BancoTableSeeder::class);
        $this->call(ProdutoTableSeeder::class);
        Model::reguard();
    }
}

class CategoriaTableSeeder extends Seeder {

    public function run() {
		Categoria::create(['nome' => 'Roupas']);
		Categoria::create(['nome' => 'Acessórios']);
    }
}

class UserTableSeeder extends Seeder {

	public function run() {
		// PASSWORD: 123456
		User::create(['name' => 'Pedro Dias', 'email' => 'pedrodias.info@gmail.com', 'password' => '$2y$10$wAgBTF61if/ee/JFMGL1KeX1s1LOsjukDHPi6oWhT9P22DKl0ICH.', 'perfil' => 1, 'created_at' => '2015-08-22', 'updated_at' => '2015-08-22'  ]);
		User::create(['name' => 'Thener Moreira', 'email' => 'thenerbh@gmail.com', 'password' => '$2y$10$wAgBTF61if/ee/JFMGL1KeX1s1LOsjukDHPi6oWhT9P22DKl0ICH.', 'perfil' => 1, 'created_at' => '2015-08-22', 'updated_at' => '2015-08-22'  ]);
	}
}

class BancoTableSeeder extends Seeder {

	public function run() {
		Banco::create(['nome' => 'Bradesco']);
		Banco::create(['nome' => 'Banco do Brasil']);
	}
}

class ProdutoTableSeeder extends Seeder {

	public function run() {
		Produto::create(['nome' => 'Camisa', 'nome_abreviado' => 'Camisa', 'categoria_id' => 1, 'preco_custo' => 10, 'preco_venda' => 20, 'estoque_atual' => 10]);
		Produto::create(['nome' => 'Blusa', 'nome_abreviado' => 'Blusa', 'categoria_id' => 1, 'preco_custo' => 20, 'preco_venda' => 30, 'estoque_atual' => 10]);
		Produto::create(['nome' => 'Calça', 'nome_abreviado' => 'Calça', 'categoria_id' => 1, 'preco_custo' => 40, 'preco_venda' => 50, 'estoque_atual' => 10]);
		Produto::create(['nome' => 'Colar', 'nome_abreviado' => 'Colar', 'categoria_id' => 2, 'preco_custo' => 15, 'preco_venda' => 25, 'estoque_atual' => 10]);
		Produto::create(['nome' => 'Brinco', 'nome_abreviado' => 'Brinco', 'categoria_id' => 2, 'preco_custo' => 18, 'preco_venda' => 28, 'estoque_atual' => 10]);
	}
}