<?php
// name, email, password
p("FUCK!");

function p($message) { echo $message . PHP_EOL; }

//function check_read($txt) {
//    if ($value = readline($txt)) {
//        return $value;
//    } else {
//        p('No input. Try again');
//    };
//    return check_read($txt);
//}

//function name_request() {
//	if ($request = filter_var(check_read("Input your name:"),FILTER_VALIDATE_EMAIL)) {
//        return $request;
//    } else {
//        return name_request($request);
//    }
//}

function name_request() {
    if ($request = filter_var($var = readline("Input your name:"))) {
        return $request;
    } else {
        p('No name. Try again!');
        return name_request();
    }
}

function email_request() {
    $email = readline("Input your email:");
    if (preg_match('/^\w+@\w+.\w+$/', $email)) {
        return $email;
    } else {
        p('Wrong email. Try again!');
        return email_request();
    }
}

function password_request() {
   if (strlen($password = readline("Input your password:")) >=8) {
      return $password;
   } else {
       p('Short password. Try again!');
       return password_request();
   }
}

function filter_password($password) {
    $str_length = strlen($password);
    return str_repeat('*', $str_length);
}

function get_user() {
    return [
        'name' => name_request(),
        'email' => email_request(),
        'password' => password_request()
    ];
}
$user = (object)get_user(); # stdClass

$filtered_password = filter_password($user->password);

echo "Your name is {$user->name} \nYour email is {$user->email} \nYour password is {$filtered_password}";

