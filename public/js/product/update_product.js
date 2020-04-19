
ck_editor_obj=CKEDITOR.replace( 'editor' ,{
    skin: 'kama',
    extraPlugins: 'colorbutton,colordialog,font',
    removeButtons: 'PasteFromWord'
});
// cross site forgery token
const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
const id= document.getElementById('id').value;

//btns click
let descriptionBtn=document.getElementById('send_description');
let metaBtn=document.getElementById('send_meta');
let keywordBtn=document.getElementById('send_keywords');
let titleBtn=document.getElementById('send_title');

//html loader
const spinnerHTML='<i class="fa fa-refresh fa-spin"></i> Loading'

descriptionBtn.addEventListener('click', function(e){
    const description=ck_editor_obj.getData();
    const innerHTML= descriptionBtn.innerHTML;
    // spinner changing
    descriptionBtn.innerHTML=spinnerHTML;

    const setting= {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        },
        credentials: "same-origin",
        body: JSON.stringify({
            description,
            id
        }),


    };

    fetch('/products/update/description',setting).then(function(res){
        return res.json();
    }).then(function(data){
        descriptionBtn.innerHTML=innerHTML;
        toastr.success('Description updated')
    }).catch(function(error){
        toastr.error('Something fail')
    });
});

// META SEND DATA
metaBtn.addEventListener('click', function(e){
    const meta=document.getElementById('metaDescription').value;
    const innerHTML= descriptionBtn.innerHTML;
    // spinner changing
    metaBtn.innerHTML=spinnerHTML;

    const setting= {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        },
        credentials: "same-origin",
        body: JSON.stringify({
            meta,
            id
        }),


    };

    fetch('/products/update/metadescription',setting).then(function(res){
        return res.json();
    }).then(function(data){
        metaBtn.innerHTML=innerHTML;
        toastr.success('Metadescription updated')
    }).catch(function(error){
        toastr.error('Something fail')
    });
});


// KEYWORD SEND DATA
keywordBtn.addEventListener('click', function(e){
    const keyword=document.getElementById('keywords').value;
    const innerHTML= keywordBtn.innerHTML;
    // spinner changing
    keywordBtn.innerHTML=spinnerHTML;

    const setting= {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        },
        credentials: "same-origin",
        body: JSON.stringify({
            keyword,
            id
        }),


    };

    fetch('/products/update/keywords',setting).then(function(res){
        return res.json();
    }).then(function(data){
        keywordBtn.innerHTML=innerHTML;
        toastr.success('Keywords updated')
    }).catch(function(error){
        toastr.error('Something fail')
    });
});

// TITLE SEND DATA


titleBtn.addEventListener('click', function(e){
    const title=document.getElementById('title').value;
    const innerHTML= titleBtn.innerHTML;
    // spinner changing
    titleBtn.innerHTML=spinnerHTML;

    const setting= {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        },
        credentials: "same-origin",
        body: JSON.stringify({
            title,
            id
        }),


    };

    fetch('/products/update/title',setting).then(function(res){
        return res.json();
    }).then(function(data){
        titleBtn.innerHTML=innerHTML;
        toastr.success('page title updated')
    }).catch(function(error){
        toastr.error('Something fail')
    });
});

