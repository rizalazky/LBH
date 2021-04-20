<?php

namespace App\Controllers;

use App\Models\NetsuiteModels;
use Error;
use PhpParser\Node\Stmt\Echo_;

class InputStruk extends BaseController
{
    // public function console_log($data)
    // {
    //     $output = $data;
    //     if (is_array($output))
    //         $output = implode(',', $output);

    //     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    // }

    protected $netsuite_models;

    public function __construct()
    {
        $this->netsuite_models = new NetsuiteModels();
        helper('form');
    }
    public function index()
    {
        return view('inputstruk');
    }
    public function post_struk()
    {
        $data = [];
        if (isset($_POST['submit'])) {
            $firstname = isset($_POST['namadepan']) ? $_POST['namadepan'] : '';
            $lastname = isset($_POST['namabelakang']) ? $_POST['namabelakang'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            if ($firstname !== '') {
                $postTo = $this->netsuite_models->postToCustomer($firstname, $lastname, $email);
            } else {
                die('error');
            }
            return redirect()->to('/inputstruk');
        } else {
            echo view('inputstruk', $data);
        }
    }
}
