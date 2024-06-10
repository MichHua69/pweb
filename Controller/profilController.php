<?php 
class profilController
{
    public static function showProfil()
    {
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
        
        if($role == 1) {
            $user = dinas_peternakanModel::getUser($user['email']);
        } elseif ($role == 2) {
            $user = kepala_kelompok_ternakModel::getUser($user['email']);
        } elseif ($role == 3) {
            $user = peternakModel::getUser($user['email']);
        }
        // var_dump($user);
        view('profil',[
            'user' => $user,
            'role' => $role
        ]);
    }

    public static function storeProfil() {
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
        // var_dump($user);
        $data = $_POST;
        if ($role == 1) {
            $data['id'] = $user['id'];
            dinas_peternakanModel::update($data);
            $user = dinas_peternakanModel::getUser($data['email']);
            $_SESSION['user'] = $user;
            // $_SESSION['user'] = dinas_peternakanModel::getUser();;
        } elseif ($role == 2) {
            $data['id'] = $user['id'];
            kepala_kelompok_ternakModel::update($data);
            $user = kepala_kelompok_ternakModel::getUser($data['email']);
            $_SESSION['user'] = $user;
        } elseif ($role == 3) {
            $data['id'] = $user['id'];
            peternakModel::update($data);
            $user = peternakModel::getUser($data['email']);
            $_SESSION['user'] = $user;
        }
        header('Location: ' . urlPath('profil'));
        exit();
    }
}
?>