<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rol;
use App\Models\Usuario;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class Instalador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog_auth:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando inicia el instalador inicial del proyecto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!$this->verificar())
        {

            $rol = $this->crearRolsuperadmin();
            $usuario = $this->crearUsuariosuperadmin();
            $usuario->roles()->attach($rol);
            $this->line('El rol y usuario se instalron correctamente');
        }
        else
        {
            $this->error('Somethings was error');
        }
    }

    private function verificar(){
        return Rol::find(1);
        
    }


    private function crearRolsuperadmin(){
        $rol = 'Super Administrador';
        return Rol::create([
            'nombre' => $rol,
            'slug' => Str::slug($rol,'_')
        ]);
    }

    private function crearUsuariosuperadmin(){
        return Usuario::create([
            'nombre' => 'super_admin',
            'email' => 'caaz@gmail.com',
            'password' => Hash::make('password123'),
            'estado' => 1
        ]);

    }
}
