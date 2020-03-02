/**
 * @date 12.2019
 * @last_change 17.12.2019
 * @version 0.3.2.0
 **/

const colorPick = "D3A53F,E6B037,F4BF49,AB842F,163A8F,505050,4D4D4D,6E6F71,7E90A1,DFDFDF,C8C8C8,E9E9E9";

const dates = {
    string: ( d = new Date() , formato = [ "dd" , "/" , "mm" , "/" , "aaaa" ] ) => {
        window[ "dd" ] = d.getDate() < 10 ? `0${d.getDate()}` : d.getDate();
        window[ "mm" ] = d.getMonth() + 1;//los meses [0 - 11]
        window.mm = window.mm < 10 ? `0${window.mm}` : window.mm;
        window[ "aaaa" ] = d.getFullYear();
        window[ "h" ] = d.getHours() < 10 ? `0${d.getHours()}` : d.getHours();
        window[ "m" ] = d.getMinutes() < 10 ? `0${d.getMinutes()}` : d.getMinutes();
        window[ "s" ] = d.getSeconds() < 10 ? `0${d.getSeconds()}` : d.getSeconds();

        let day = "";
        formato.forEach( ( x ) => {
            if( [ "dd" , "mm" , "aaaa" , "h" , "m" , "s" ].includes( x ) )
                day += window[ x ];
            else
                day += x;
        } );
        return day;
    },
    convert: ( d ) => {
        return (
            d.constructor === Date ? d :
            d.constructor === Array ? new Date( d[ 0 ] , d [ 1 ] , d[ 2 ] ) :
            d.constructor === Number ? new Date( d ) :
            d.constructor === String ? new Date( d ) :
            typeof d === "object" ? new Date( d.year , d.month , d.date ) :
            NaN
        );
    },
    /**
     * @return -1 if a < b
     * @return 0 if a = b
     * @return 1 if a > b
     */
    compare: ( a , b ) => {
        return ( ( a.getTime() === b.getTime() ) ? 0 : ( ( a.getTime() > b.getTime() ) ? 1 : - 1 ) );
    }
};

/** ------------------------------------------------
 ** -------------- FUNCIONES BÁSICAS <--------------
 ** ------------------------------------------------
 ** ------------------------------------------------ */
alertify.defaults.transition = "slide";
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.defaults.theme.input = "form-control";
/** -------------------------------------
 *      FORMATO MONEDA
 ** ------------------------------------- */
formatter = new Intl.NumberFormat('es-AR', {
    style: 'currency',
    currency: 'ARS',
});
Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
menu = ( t ) => {
    if( $( "#sidebar.compact" ).length ) {
        localStorage.removeItem( "sidebar" );
        $( "#sidebar.compact" ).removeClass( "compact" );
        $( t ).find( "i" ).addClass( "fa-bars" ).removeClass( "fa-times" );
    } else {
        localStorage.setItem( "sidebar" , "1" );
        $( "#sidebar" ).addClass( "compact" );
        $( t ).find( "i" ).addClass( "fa-times" ).removeClass( "fa-bars" );
    }
};
changeCkeditor = ( x , evt ) => {};
menuBody = ( t ) => {
    if( window.typeMENU === undefined ) {
        window.typeMENU = 1;
        document.getElementById("wrapper-body").animate([
            { transform: 'translateX(0px)' },
            { transform: 'translateX(-300px)' }
        ], {
            fill: "forwards",
            duration: 600,
        });
        document.getElementById("hamburger-").classList.remove( "d-none" );
        document.getElementById("wrapper-body").classList.add( "isDisabled" );
        document.getElementById("hamburger").classList.add( "open" );
        document.getElementById("wrapper-menu").animate([
            { transform: 'translateX(0px)' },
            { transform: 'translateX(-300px)' }
        ], {
            fill: "forwards",
            duration: 600,
        });
    } else {
        delete window.typeMENU;
        document.getElementById("wrapper-body").animate([
            { transform: 'translateX(-300px)' }, 
            { transform: 'translateX(0px)' }
        ], {
            fill: "forwards",
            duration: 600,
        });
        document.getElementById("hamburger-").classList.add( "d-none" );
        document.getElementById("wrapper-body").classList.remove( "isDisabled" );
        document.getElementById("hamburger").classList.remove( "open" );
        document.getElementById("wrapper-menu").animate([
            { transform: 'translateX(-300px)' }, 
            { transform: 'translateX(0px)' }
        ], {
            fill: "forwards",
            duration: 600,
        });
    }
};
navMenu = ( t ) => {
    if( $( ".app-body.isDisabled").length )
        $( ".app-body.isDisabled").removeClass( "isDisabled" );
    else
        $( ".app-body").addClass( "isDisabled" );
};

/** -------------------------------------
 *      CAMBIAR COLORES
 ** ------------------------------------- */
changeColor = ( t , target ) => {
    $( `#${target}` ).val( $( t ).val() );
};
/** -------------------------------------
 *      MOSTRAR TÉRMINOS
 ** ------------------------------------- */
terminosShow = ( t , btn ) => {
    if( $( t ).is( ":checked" ) ) {
        $( "#terminosModal" ).modal( "show" );
        $( `#${btn}` ).prop( "disabled" , false );
    } else
        $( `#${btn}` ).prop( "disabled" , true );
};
/** -------------------------------------
 *      MOSTRAR COMBINACIONES DE TECLAS
 ** ------------------------------------- */
showCombinacion = ( t ) => {
    $( "#modalCombinacion" ).modal( "show" );
};

/** -------------------------------------

 *      COPIAR IMAGEN

 ** ------------------------------------- */

copy = ( t , url ) => {
    $temp = $( `<input>` );
    $( `body` ).append( $temp );
    $temp.val( url ).select();
    document.execCommand( "copy" );
    $temp.remove();
    Toast.fire({
        icon: 'success',
        title: 'URL de imagen copiada'
    });
};

/** -------------------------------------

 *      ELIMINAR REGISTRO

 ** ------------------------------------- */
erase = ( t , id ) => {
    window.pyrus.delete( t , { title : "ATENCIÓN" , body : "¿Eliminar registro?" } , `${url_simple}/adm/${window.pyrus.name}/delete` , id );
};
/** -------------------------------------
 *      LIMPIAR FORMULARIO
 ** ------------------------------------- */
remove = ( t ) => {
    $( '[data-toggle="tooltip"]' ).tooltip( 'hide' );
    Swal.fire({
        title: '¿Cerrar sin guardar registro?',
        text: "Perderá la información añadida",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar'
    }).then( ( result ) => {
        if ( result.value ) {
            window.pyrus.clean( CKEDITOR );
            if( $( "#formModal" ).length )
                $( "#formModal" ).modal( "hide" );
            add( $( "#btnADD" ) );
        }
    })
};
removeImage = ( t ) => {
    let button = $( t );
    let id = button.prop( "id" );
    id = id.replace( "_button" , "" );
    $( `#${id}` ).val( "" );
    id = `src-${id}`;
    $( `#${id}` ).prop( `src` , $( `#${id}` ).data( "src" ) );
    $( `#${id}-2` ).prop( `src` , $( `#${id}-2` ).data( "src" ) );
    button.prop( `disabled` , true );
};
removeFile = ( t ) => {
    let button = $( t );
    let content = button.closest( ".input-group" );

    content.find( "input" ).val( "" );
};
/** -------------------------------------
 *      MODO TEST: QUITAR ELEMENTO
 ** ------------------------------------- */
remove_ = ( t , class_ ) => {
    let target =  $( t ).closest( `.${class_}` );
    Swal.fire({
        title: "Atención!",
        text: "¿Eliminar elemento?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',

        confirmButtonText: '<i class="fas fa-check"></i> Confirmar',
        confirmButtonAriaLabel: 'Confirmar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        cancelButtonAriaLabel: 'Cancelar'
    }).then( ( result ) => {
        if ( result.value ) {
            if( window.imgDelete === undefined )
                window.imgDelete = [];
            if( target.find( ".imgURL" ).val() != "" )
                window.imgDelete.push( target.find( ".imgURL" ).val() );
            target.remove();
            Toast.fire({
                icon: 'warning',
                title: 'Debe guardar el contenido para ver los cambios'
            })
        }
    });
};
/** -------------------------------------
 *      EDITAR REGISTRO
 ** ------------------------------------- */
edit = ( t , id ) => {
    $( t ).prop( "disabled" , true );
    window.pyrus.one( `${url_simple}/adm/${window.pyrus.name}/${id}/edit`, function( res ) {
        $( '[data-toggle="tooltip"]' ).tooltip( 'hide' );
        $( t ).prop( "disabled" , false );
        add( $( "#btnADD" ) , parseInt( id ) , res.data );
    } );
};
/** -------------------------------------
 *      PREVIEW DE IMAGEN
 ** ------------------------------------- */
readURL = ( input , target ) => {
    if ( input.files && input.files[ 0 ] ) {
        let reader = new FileReader();
        reader.onload = ( e ) => {
            $( `#${target}` ).prop( `src` , `${e.target.result}` );
            $( `#${target}-2` ).prop( `src` , `${e.target.result}` );
            target = target.replace( "src-" , "" );
            $( `#${target}_button` ).prop( `disabled` , false );
        };
        reader.readAsDataURL( input.files[ 0 ] );
    }
};
/** -------------------------------------
 *      CHECKBOX
 ** ------------------------------------- */
check = ( i ) => {
    if( $( i ).prop( "checked" ) )
        $( i ).find( "+ input").val( 1 );
    else
        $( i ).find( "+ input").val( 0 );
};
/** -------------------------------------
 *      GUARDAR ELEMENTO
 ** ------------------------------------- */
formSave = ( t , formData , message = { wait : "Espere. Guardando contenido" , err: "Ocurrió un error en el guardado. Reintente" , catch: "Ocurrió un error en el guardado." , success : "Contenido guardado" } , callback = null ) => {
    let url = t.action;
    let method = t.method;
    if( !verificarForm() )
        return null;
    method = (method == "GET" || method == "get") ? "post" : method;
    $( "body > .wrapper" ).addClass( "isDisabled" );
    Toast.fire({
        icon: 'warning',
        title: message.wait
    })
    if( window.imgDelete !== undefined )
        formData.append( "REMOVE" , JSON.stringify( window.imgDelete ) );
    axios({
        method: method,
        url: url,
        data: formData,
        responseType: 'json',
        config: { headers: {'Content-Type': 'multipart/form-data' }}
    })
    .then((res) => {
        if( callback === null ) {
            if(parseInt(res.data) == 1) {
                Toast.fire({
                    icon: 'success',
                    title: message.success
                })
                location.reload();
            } else  {
                $( "body > .wrapper" ).removeClass( "isDisabled" );
                Toast.fire({
                    icon: 'error',
                    title: message.err
                })
            }
        } else {
            callback.call( this , res.data );
        }
    })
    .catch((err) => {
        $( "body > .wrapper" ).removeClass( "isDisabled" );
        console.error( `ERROR en ${url}` );
        alertify.error( message.catch );
    })
    .then(() => {});
};

verificarForm = () => {
    if( window.ARR_pyrus === undefined ) {
        if( window.pyrus === undefined )
            return true;
        if( window.pyrus.objeto.NECESARIO !== undefined ) {
            flag = 0;
            alert = "";
            for( let x in window.pyrus.objeto.NECESARIO ) {
                if( window.pyrus.objeto.NECESARIO[ x ][ window.formAction ] !== undefined ) {    
                    if( $(`#${window.pyrus.name}_${x}`).length) {
                        if( $(`#${window.pyrus.name}_${x}`).is( ":invalid" ) || $(`#${window.pyrus.name}_${x}`).val() == "" ) {
                            if( alert != "" )
                                alert += ", ";
                            alert += window.pyrus.especificacion[ x ].NOMBRE;
                            flag = 1;
                        }
                    }
                }
            }
            if( flag ) {
                Swal.fire(
                    'Atención',
                    `Complete los siguientes campos: ${alert}`,
                    'error'
                )
                return false;
            }
            return true;
        }
    } else {
        flag = 0;
        for( i = 0 ; i < window.ARR_pyrus.length ; i++ ) {
            alert = "";
            p = window.ARR_pyrus[ i ];
            if( window[ p ].objeto.NECESARIO !== undefined ) {
                for( let x in window[ p ].objeto.NECESARIO ) {
                    if( window[ p ].objeto.NECESARIO[ x ][ window.formAction ] !== undefined ) {
                        if( $(`#${window[ p ].name}_${x}`).is( ":invalid" ) || $(`#${window[ p ].name}_${x}`).val() == "" ) {
                            if( alert != "" )
                                alert += ", ";
                            alert += window[ p ].especificacion[ x ].NOMBRE;
                            flag = 1;
                        }
                    }
                }
                if( flag )
                    Swal.fire(
                        'Atención',
                        `Complete los siguientes campos: ${alert}`,
                        'error'
                    )
            }
        }
        if( flag )
            return false;
    }
    return true
};
/** -------------------------------------
 *      OBJETO A GUARDAR
 ** ------------------------------------- */
formSubmit = ( t ) => {
    let idForm = t.id;
    let formElement = document.getElementById( idForm );
    let formData = new FormData( formElement );
    formData.append("ATRIBUTOS",JSON.stringify(
        [
            { DATA: window.pyrus.objetoSimple , TIPO: "U" }
        ]
    ));

    for( let x in CKEDITOR.instances )
        formData.set( x , CKEDITOR.instances[ `${x}` ].getData() );
    formSave( t , formData );
};

searchTable = ( t ) => {
    let idForm = t.id;
    let formElement = document.getElementById( idForm );
    let formData = new FormData( formElement );
    let url = t.action;
    let method = t.method;
    
    axios({
        method: method,
        url: url,
        data: formData,
        responseType: 'json',
        config: { headers: {'Content-Type': 'multipart/form-data' }}
    })
    .then((res) => {
        if( callback === null ) {
            if(parseInt(res.data) == 1) {
                alertify.success( message.success );
            } else  {
                $( "body > .wrapper" ).removeClass( "isDisabled" );
                alertify.error( message.err );
            }
        } else {
            callback.call( this , res.data );
        }
    })
    .catch((err) => {
    })
    .then(() => {});
};
/** -------------------------------------
 *      ABRIR FORMULARIO
 ** ------------------------------------- */
add = ( t , id = 0 , data = null ) => {
    let btn = $(t);
    let action = `${url_simple}/adm/${window.pyrus.name}`;
    let method = "POST";
    window.formAction = "CREATE";
    window.elementData = data;

    $( "#formModalLabel" ).text( "Nuevo elemento" );
    if(id != 0) {
        $( "#formModalLabel" ).text( "Editar elemento" );
        action = `${url_simple}/adm/${window.pyrus.name}/update/${id}`
        method = "PUT";
        $( "#form" ).data( "id" , id );
        window.formAction = "UPDATE";
    }
    window.pyrus.show( CKEDITOR , url_simple , data );
    $( "#form" ).prop( "action" , action ).prop( "method" , method );
    $( "#formModal" ).modal( "show" );
    $('.modal input[type="text"]:visible:enabled:first').focus();
    addfinish( data );
};
addfinish = ( data = null ) => {};
/** -------------------------------------
 *      ELIMINAR ARCHIVO
 ** ------------------------------------- */
deleteFile = ( t , url , txt ) => {
    alertify.confirm( "ATENCIÓN" ,`${txt}`,
        () => {
            axios.get( url, {
                responseType: 'json'
            })
            .then(( res ) => {
                if( res.data ) {
                    alertify.success( "Archivo eliminado" );
                    $( t ).prop( "disabled" , true );
                    location.reload();
                } else {
                    alertify.error( "Ocurrió un error. Reintente" );
                    $( t ).prop( "disabled" , false );
                }
            })
            .catch(( err ) => {
                alertify.error( "Ocurrió un error" );
                $( t ).prop( "disabled" , false );
                console.error( `ERROR en ${url}` );
            })
            .then(() => {});
        },
        () => {
            $( t ).prop( "disabled" , false );
        }
    ).set( 'labels' , { ok : 'Confirmar' , cancel : 'Cancelar' } );
};
/** -------------------------------------
 *      COMBINACIÓN DE TECLAS
 ** ------------------------------------- */
shortcut.add( "Alt+Ctrl+S" , function () {
    if( $( "#form" ).is( ":visible" ) )
        $( "#form" ).submit();
}, {
    type: "keydown",
    propagate: true,
    target: document
});
shortcut.add( "Alt+Ctrl+N" , function () {
    if( $( "#btnADD" ).length ) {
        if( !$( "#form" ).is( ":visible" ) )
            $( "#btnADD" ).click();
        else
            remove( null );
    }
}, {
    type: "keydown",
    propagate: true,
    target: document
});
/** -------------------------------------
 *      INICIO
 ** ------------------------------------- */

init = ( callbackOK , table = true , type = "table" , without = false ) => {
    /** */
    $( "#form .modal-body" ).html( window.pyrus.formulario() );
    if( !without )
        $( "#wrapper-tabla > div.card-body" ).html( window.pyrus.table( [ { NAME:"ACCIONES" , COLUMN: "acciones" , CLASS: "text-center" , WIDTH: "150px" } ] ) );
    else
        $( "#wrapper-tabla > div.card-body" ).html( window.pyrus.table() );
    
    window.pyrus.editor( CKEDITOR );
    if( table ) {
        if( type == "table" )
            if( !without )
                window.pyrus.elements( $( "#tabla" ) , url_simple , window.data.elementos , [ "e" , "d" ] );
            else
                window.pyrus.elements( $( "#tabla" ) , url_simple , window.data.elementos , [] );
        else
            $( "#wrapper-tabla > div.card-columns" ).html( window.pyrus.card( url_simple , window.data.elementos , [ "d" ] ) );
    }
    callbackOK.call( this , null );
};