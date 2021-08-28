<?php

namespace App\Http\Controllers;

use App\Mail\SendNewIp;
use App\Models\Config;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

use stdClass;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class ConfigController extends Controller
{
    public function index()
    {

        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }

        $dbconfig = Config::where('option', 'externalip')->first();

        $teams = Team::all();

        $configs = new stdClass();
        $configs->timezone = config('app.timezone');
        $configs->db_connection = env('DB_CONNECTION');
        $configs->app_name = env('APP_NAME');
        $configs->app_debug = env('APP_DEBUG');
        $configs->db_host = env('DB_HOST');
        $configs->db_port = env('DB_PORT');
        $configs->db_database = env('DB_DATABASE');
        $configs->db_username = env('DB_USERNAME');
        //$configs->db_password = env('DB_PASSWORD');
        $configs->mail_host = env('MAIL_HOST');
        $configs->mail_port = env('MAIL_PORT');
        $configs->mail_username = env('MAIL_USERNAME');
        $configs->mail_password = env('MAIL_PASSWORD');
        $configs->mail_from_address = env('MAIL_FROM_ADDRESS');
        $configs->mail_cc = env('MAIL_CC');

        $configs->teams_manager = env('TEAMS_MANAGER');
        $configs->teams_finance = env('TEAMS_FINANCE');
        $configs->teams_teacher = env('TEAMS_TEACHER');
        $configs->teams_sales = env('TEAMS_SALES');
        try {
            $configs->externalip = $dbconfig['key'];
        } catch (Exception $err) {
            $configs->externalip = '';
        }

        session(['page' => 'configs']);
        return view('configs.show', ['configs' => $configs, 'teams' => $teams]);
    }

    public function update(Request $request)
    {

        Env::enablePutenv();
        config(['app.timezone' => $request->timezone]);
        //env(['DB_CONNECTION' => $request->db_connection]);
        //env(['APP_NAME' => $request->app_name]);
        //env(['APP_DEBUG' => $request->app_debug]);
        //env(['DB_HOST' => $request->db_host]);
        //env(['DB_PORT' => $request->db_port]);
        //env(['DB_DATABASE' => $request->db_database]);
        //env(['DB_USERNAME' => $request->db_user]);
        //env(['DB_PASSWORD' => $request->db_password]);
        config(['MAIL_HOST' => $request->mail_host]);
        putenv('MAIL_HOST=' . $request->mail_host);
        //env(['MAIL_PORT' => $request->mail_port]);
        //env(['MAIL_USERNAME' => $request->mail_username]);
        //env(['MAIL_PASSWORD' => $request->mail_password]);
        //env(['MAIL_FROM_ADDRESS' => $request->mail_from_address]);
        //env(['MAIL_CC' => $request->mail_cc]);

        // env(['TEAMS_MANAGER' => $request->teams_manager]);
        //env(['TEAMS_FINANCE' => $request->teams_finance]);
        //env(['TEAMS_TEACHER' => $request->teams_teacher]);
        //env(['TEAMS_SALES' => $request->teams_sales]);
        Env::disablePutenv();
        return redirect('/');
    }

    public function checkip()
    {
        $externalContent = file_get_contents('https://ipecho.net/plain');
        $sendEmail = true;

        $config = Config::where('option', 'externalip')->first();

        /** Se não existir o IP na base, irá gravar */
        if (!isset($config->key)) {
            $config = new Config;
            $config->option = 'externalip';
            $config->key = $externalContent;
            $config->save();
        } else {
            $config = $config;
        }

        /** Atualiza a base se o IP anterior for diferente do atual */
        if ($config->key != $externalContent) {
            $config->key = $externalContent;
            $config->save();
        } else {
            $sendEmail = false;
        }

        /** Envia email informando o novo IP */
        if ($sendEmail) {
            Mail::to(env('MAIL_CC'))
                ->send(new SendNewIp($config));
        }
        //return json_encode($config);
    }
}
