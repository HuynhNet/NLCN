function Test_numberphone() {
    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    var mobile = $('#txt_sdt').val();
    if(mobile !==''){
        if (vnf_regex.test(mobile) == false) 
        {
            alert('Số điện thoại không đúng định dạng. Vui lòng nhập lại');
            window.location.replace(true);
        }
    }
}