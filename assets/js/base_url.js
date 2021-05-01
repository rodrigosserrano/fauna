function BaseURL(){  
    if(window.location.origin != 'http://localhost' && window.location.origin != 'http://lds.codeigniter-dev/'){
        return base_url = 'http://localhost:81/fauna/';
    }else if(window.location.origin != 'http://localhost'){
        return base_url = 'http://lds.codeigniter-dev/';
    }else{
        return base_url = 'http://localhost/fauna/';
    }
}

export function base_url() {
    return base_url();
}