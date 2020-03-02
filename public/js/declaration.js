/**
 * ----------------------------------------
 *              CONSIDERACIONES
 * ---------------------------------------- */
/**
 * Las entidades nombradas a continuación tienen referencia con una tabla de la BASE DE DATOS.
 * Respetar el nombre de las columnas
 * 
 * @version 2
 */
const ENTIDADES = {
    slider: {
        //TABLE: "sliders",
        ATRIBUTOS: {
            order:      {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            image:      {TIPO:"TP_IMAGE",FOLDER:"sliders",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 1366px X 527px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"450px"},
            section:    {TIPO:"TP_STRING",VISIBILIDAD:"TP_INVISIBLE",NOMBRE:"sección"},
            text:    {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE",FIELDSET:1,NOMBRE:"texto"}
        },
        FORM: [
            {
                '/section/<div class="col-12 col-md-8">/text/</div><div class="col-12 col-md-4"><div class="row d-flex justify-content-center"><div class="col-md-6 mb-3">/order/</div><div class="col-12">/image/</div></div>':['section','order','text','image'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ]},
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'links'},
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                ],
                colorButton_colors : colorPick,
                removeButtons: 'CreateDiv,Language'
            }
        }
    },

    contenido_home_title: {
        ATRIBUTOS: {
            text: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"título",CLASS:"border-left-0 text-center bg-transparent border-right-0 border-top-0 rounded-0"}
        },
        
        FORM: [
            {
                '<div class="col-12">/text/</div>':['text']
            },
        ],
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ]},
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'links'},
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                ],
                colorButton_colors : colorPick,
                removeButtons: 'CreateDiv,Language',
                height: '70px'
            }
        }
    },
    contenido_home_icono: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",MAXLENGTH:2,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",CLASS:"border-left-0 border-right-0 bg-transparent border-top-0 rounded-0",SIMPLE:1},
            image: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 105px X 105px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"ícono",WIDTH:"105px"},
            text: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE_FORM",FIELDSET:1,NOMBRE:"texto"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-4">/order/</div>': ['order']
            },
            {
                '<div class="col-12">/image/</div>':['image']
            },
            {
                '<div class="col-12">/text/</div>' : [ 'text' ]
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language,NumberedList,BulletedList,Outdent,Indent,Blockquote,CreateDiv,BidiLtr,BidiRtl',
                colorButton_colors : colorPick,
                height: '70px'
            }
        }
    },
    contenido_empresa: {
        ATRIBUTOS: {
            title: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE_FORM",FIELDSET:1,NOMBRE:"título"},
            image: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 504px X 755px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"ícono",WIDTH:"504px"},
            text: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE_FORM",FIELDSET:1,NOMBRE:"texto"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-5">/image/</div><div class="col-12 col-md-7"><div class="row"><div class="col-12">/title/</div><div class="col-12 mt-3">/text/</div></div></div>': ['image','text' , 'title']
            }
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '350px'
            },
            title: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language,NumberedList,BulletedList,Outdent,Indent,Blockquote,CreateDiv,BidiLtr,BidiRtl',
                colorButton_colors : colorPick,
                height: '70px'
            }
        }
    },
    
    /**********************************
            CATEGORIA
     ********************************** */
    categoria: {
        TABLE: "categorias",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
            image: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 367px X 206px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"367px"},
            logo: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - (?)px X (?)px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"logo",WIDTH:"90px"},
            resume: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE_FORM",FIELDSET:1,NOMBRE:"resumen"},
            //is_destacado: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE",CHECK:"¿Categoría destacada?",NOMBRE:"Destacado",OPTION:{ "" : "NO" , true : "Si"}},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-6">/image/</div><div class="col-12 col-md-6">/logo/</div>': ['image','logo']
            },
            {
                '<div class="col-12 col-md-4">/order/</div><div class="col-12 col-md">/title/</div>': ['title','order']
            },
            {
                '<div class="col-12">/resume/</div>': ['resume']
            },
            /*{
                '<div class="col-12">/is_destacado/</div>': ['is_destacado']
            }*/
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
            logo: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
        EDITOR: {
            resume: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '150px'
            },
        }
    },

    /**********************************
            SUBCATEGORIA
     ********************************** */
    subcategoria: {
        TABLE: "subcategorias",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
            subtitle: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:100,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"subtítulo"},
            image: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 400px X 400px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"367px"},
            categoria_id: {TIPO:"TP_RELACION",VISIBILIDAD:"TP_INVISIBLE"},
            is_destacado: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE",CHECK:"¿Subcategoría destacada?",NOMBRE:"Destacado",OPTION:{ "" : "NO" , true : "Si"}},
        },
        
        FORM: [
            {
                '/categoria_id/<div class="col-12 col-md-6">/image/</div>': ['image','categoria_id']
            },
            {
                '<div class="col-12 col-md-4">/order/</div><div class="col-12 col-md">/title/</div>': ['title','order']
            },
            {
                '<div class="col-12">/subtitle/</div>': ['subtitle']
            },
            {
                '<div class="col-12">/is_destacado/</div>': ['is_destacado']
            }
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    
    /**********************************
            VIDEOS
     ********************************** */
    video: {
        TABLE: "videos",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
            url: {TIPO:"TP_YOUTUBE",LABEL:1,MAXLENGTH:25,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"Código de Youtube",HELP:"Código: https://www.youtube.com/watch?v=<strong>XXXXXXXXXXX</strong>"}
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-4">/order/</div><div class="col-12 col-md">/title/</div>': ['title','order']
            },
            {
                '<div class="col-12">/url/</div>': ['url']
            }
        ]
    },
    
    /**********************************
            BLOG
     ********************************** */
    blog: {
        TABLE: "blogs",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            date: {TIPO:"TP_FECHA",FORMAT:[ "dd" , "/" , "mm" , "/" , "aaaa" ],VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0 text-right",NOMBRE:"fecha"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
            resume: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"resumen"},
            text: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"detalles"},
            image: {TIPO:"TP_ARRAY",COLUMN:"image",VISIBILIDAD:"TP_VISIBLE_TABLE",NOMBRE:"imágenes",CLASS:"text-center"},
            category_id: {TIPO:"TP_ENUM",CLASS:"selectpicker",VISIBILIDAD:"TP_VISIBLE",ENUMOP:"categorias",NOMBRE:"categoria",LABEL:1},
            is_destacado: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE",CHECK:"¿Noticia destacada?",NOMBRE:"Destacado",OPTION:{ "" : "NO" , true : "Si"}},
            in_home: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE",CHECK:"¿Mostrar noticia en la HOME?",NOMBRE:"en home",OPTION:{ "" : "NO" , true : "Si"}},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-3">/order/</div><div class="col-12 col-md">/title/</div>': ['title','order']
            },
            {
                '<div class="col-12 col-md">/category_id/</div><div class="col-12 col-md">/date/</div>':['category_id','date']
            },
            {
                '<div class="col-12">/is_destacado//in_home/</div>': ['is_destacado','in_home']
            },
            {
                '<div class="col-12">/resume/</div>': ['resume']
            },
            {
                '<div class="col-12">/text/</div>': ['text']
            }
        ],
        EDITOR: {
            resume: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '150px'
            },
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '450px'
            }
        }
    },
    blog_images: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",MAXLENGTH:2,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",CLASS:"border-left-0 border-right-0 bg-transparent border-top-0 rounded-0",SIMPLE:1},
            image: {TIPO:"TP_IMAGE",FOLDER:"blog",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 762px X 425px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"762px"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md">/order/</div>':['order']
            },
            {
                '<div class="col-12">/image/</div>':['image'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },

    /**********************************
            PRODUCTOS
     ********************************** */
    producto: {
        TABLE: "productos",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
            subtitle: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:100,VISIBILIDAD:"TP_VISIBLE_FORM",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"subtítulo"},
            descripcion: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"descripción"},
            utilidad: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"utilidades"},
            text: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"texto"},
            manual: {TIPO:"TP_FILE",FOLDER:"manual",NECESARIO:1,VALID:"seleccionado",INVALID:"Ext: JPG, PDF, EXE, DBF, XLS y TXT",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/jpeg,application/pdf,.exe,.dbf,.DBF,.txt,.xls,.xlsx",NOMBRE:"Manual de uso",SIMPLE:1},
            image: {TIPO:"TP_ARRAY",COLUMN:"images",VISIBILIDAD:"TP_VISIBLE_TABLE",NOMBRE:"imágenes",CLASS:"text-center"},
            categoria_id: {TIPO:"TP_ENUM",CLASS:"selectpicker",VISIBILIDAD:"TP_VISIBLE",ENUMOP:"categorias",NOMBRE:"categoria",LABEL:1},
            is_nuevo: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE_FORM",CHECK:"¿Producto nuevo?",NOMBRE:"Nuevo",OPTION:{ "" : "NO" , true : "Si"}},
            is_destacado: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE",CHECK:"¿Producto destacado?",NOMBRE:"Destacado",OPTION:{ "" : "NO" , true : "Si"}},
            youtube: {TIPO:"TP_YOUTUBE",LABEL:1,MAXLENGTH:20,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"Código de Youtube",HELP:"Código: https://www.youtube.com/watch?v=<strong>XXXXXXXXXXX</strong>"}
        },
        
        FORM: [
            {
                '<div class="col-12" id="images-target"></div>': ['VACIO']
            },
            {
                '<div class="col-12">/manual/</div>': ['manual']
            },
            {
                '<div class="col-12 col-md-6"><div class="row"><div class="col-12 col-md-3">/order/</div><div class="col-12 col-md">/title/</div><div class="col-12 mt-3">/subtitle/</div><div class="col-12 mt-3">/categoria_id/</div><div class="col-12 mt-3">/is_destacado//is_nuevo/</div><div class="col-12 mt-3">/youtube/</div></div></div><div class="col-12 col-md-6">/descripcion/</div>': ['descripcion','title','order','subtitle','categoria_id','is_destacado','is_nuevo','youtube']
            },
            {
                '<div class="col-12">/utilidad/</div><div class="col-12 mt-3" id="caracteristicas-target"></div>': ['utilidad']
            },
            {
                '<div class="col-12">/text/</div><div class="col-12 mt-3" id="planos-target"></div><div class="col-12 mt-3" id="accesorios-target"></div>': ['text']
            }
        ],
        EDITOR: {
            descripcion: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '200px'
            },
            utilidad: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '150px'
            },
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'document', groups : [ 'mode' , 'document' , 'doctools' ] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'insert' },
                ],
                removeButtons: 'CreateDiv,Language,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Save,NewPage,Preview,Print,Templates',
                colorButton_colors : colorPick,
                height: '350px'
            }
        }
    },
    producto_images: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",MAXLENGTH:2,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",CLASS:"border-left-0 border-right-0 bg-transparent border-top-0 rounded-0",SIMPLE:1},
            image: {TIPO:"TP_IMAGE",FOLDER:"productos",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 366px X 394px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"366px"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md">/order/</div>':['order']
            },
            {
                '<div class="col-12">/image/</div>':['image'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    producto_planos: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",MAXLENGTH:2,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",CLASS:"border-left-0 border-right-0 bg-transparent border-top-0 rounded-0",SIMPLE:1},
            image: {TIPO:"TP_IMAGE",FOLDER:"planos",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 446px X 240px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"446px"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-5">/order/</div>':['order']
            },
            {
                '<div class="col-12">/image/</div>':['image'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    producto_accesorios: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",MAXLENGTH:2,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",CLASS:"border-left-0 border-right-0 bg-transparent border-top-0 rounded-0",SIMPLE:1},
            image: {TIPO:"TP_IMAGE",FOLDER:"accesorios",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 267px X 197px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"267px"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0 bg-transparent",NOMBRE:"título"},
            text: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"descripción"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-4">/order/</div>':['order']
            },
            {
                '<div class="col-12 col-md">/title/</div>':['title']
            },
            {
                '<div class="col-12">/image/</div>':['image'],
            },
            {
                '<div class="col-12">/text/</div>':['text'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] }
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '150px'
            }
        }
    },
    producto_caracteristicas: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",MAXLENGTH:2,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",CLASS:"border-left-0 border-right-0 bg-transparent border-top-0 rounded-0",SIMPLE:1},
            image: {TIPO:"TP_IMAGE",FOLDER:"caracteristicas",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 50px X 50px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"50px"},
            text: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE_FORM",NOMBRE:"texto"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-5">/order/</div>':['order']
            },
            {
                '<div class="col-12">/image/</div>':['image']
            },
            {
                '<div class="col-12">/text/</div>': ['text'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] }
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '80px'
            }
        }
    },
    
    /**********************************
            BLOG CATEGORIAS
     ********************************** */
    blogcategoria: {
        TABLE: "blogcategorias",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-4">/order/</div><div class="col-12 col-md">/title/</div>': ['title','order']
            }
        ]
    },
    /**********************************
            DESCARGAS
     ********************************** */
    descarga: {
        TABLE: "descargas",
        ATRIBUTOS: {
            image: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Archivo - 365px X 281px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"365px"},
            type: {TIPO:"TP_ENUM",ENUM:{ 0 : "Pública" , 1 : "Catálogo (Privada)" , 2 : "Listas de precios (Privada)" },VISIBILIDAD:"TP_VISIBLE",NOMBRE:"tipo",COMUN:1},
            name: {TIPO:"TP_STRING",CLASS:"border-left-0 border-top-0 rounded-0 border-right-0 bg-transparent",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"nombre"},
            parts: {TIPO:"TP_ARRAY",COLUMN:"file",VISIBILIDAD:"TP_VISIBLE_TABLE",NOMBRE:"partes",CLASS:"text-center"}
        },
        FORM: [
            {
                '<div class="col-12 col-md-4 align-self-end">/type/</div><div class="col-12 col-md">/name/</div>':['name','type'],
            },
            {
                '<div class="col-12">/image/</div>':['image'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
            type: {onchange:"verificar(this)"},
        },

        NECESARIO: {
            'type' : { CREATE : 1 , UPDATE : 1 },
            'name' : { CREATE : 1 , UPDATE : 1 },
        },
    },

    descarga_parte: {
        ATRIBUTOS: {
            order: {TIPO:"TP_ENTERO",CLASS:"border-left-0 rounded-0 bg-transparent border-right-0 border-top-0",VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orden",SIMPLE:1},
            file: {TIPO:"TP_FILE",FOLDER:"descargas",NECESARIO:1,VALID:"seleccionado",INVALID:"Ext: JPG, PDF, EXE, DBF, XLS y TXT",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/jpeg,application/pdf,.exe,.dbf,.DBF,.txt,.xls,.xlsx",NOMBRE:"Archivo",SIMPLE:1},
            name: {TIPO:"TP_STRING",CLASS:"border-left-0 border-top-0 rounded-0 border-right-0 bg-transparent",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"nombre"}
        },
        FORM: [
            {
                '<div class="col-12 col-md-4 align-self-end">/order/</div>':['order'],
            },
            {
                '<div class="col-12 col-md">/file/</div>':['file']
            },
            {
                '<div class="col-12">/name/</div>':['name'],
            },
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    
    /**********************************
            SERVICIOS
     ********************************** */
    servicio: {
        TABLE: "servicios",
        ATRIBUTOS: {
            order: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase text-center border-left-0 border-right-0 border-top-0 rounded-0",WIDTH:"70px",NOMBRE:"orden"},
            title: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"título"},
            image: {TIPO:"TP_ARRAY",COLUMN:"image",VISIBILIDAD:"TP_VISIBLE_TABLE",NOMBRE:"imágenes",CLASS:"text-center"},
            resume: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE_FORM",FIELDSET:1,NOMBRE:"resumen"},
            text: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE_FORM",FIELDSET:1,NOMBRE:"texto"},
            youtube: {TIPO:"TP_YOUTUBE",LABEL:1,MAXLENGTH:20,VISIBILIDAD:"TP_VISIBLE",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",NOMBRE:"Código de Youtube",HELP:"Código: https://www.youtube.com/watch?v=<strong>XXXXXXXXXXX</strong>"}
        },
        
        FORM: [
            {
                '<div class="col-12 col-md-4">/order/</div><div class="col-12 col-md">/title/</div>': ['title','order']
            },
            {
                '<div class="col-12">/resume/</div>': ['resume']
            },
            {
                '<div class="col-12">/text/</div>': ['text']
            },
            {
                '<div class="col-12">/youtube/</div>': ['youtube']
            }
        ],
        EDITOR: {
            resume: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '150px'
            },
            text: {
                toolbarGroups: [
                    { name: "basicstyles", groups: ["basicstyles"] },
                    { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                ],
                removeButtons: 'CreateDiv,Language',
                colorButton_colors : colorPick,
                height: '350px'
            }
        }
    },

    header_contacto: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 150px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    header_videos: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 457px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    header_productos: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 300px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    header_blogs: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 457px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    header_servicios: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 457px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    header_presupuesto: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 457px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    header_descargas: {
        ATRIBUTOS: {
            header: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"1366px X 457px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"100%"},
        },
        FORM: [
            {
                '<div class="col-12">/header/</div>':['header']
            }
        ],
        FUNCIONES: {
            header: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
        }
    },
    /**********************************
            CLIENTES
     ********************************** */
    cliente: {
        TABLE: "clientes",
        ATRIBUTOS: {
            username: {TIPO:"TP_STRING",MAXLENGTH:30,NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"usuario",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            name: {TIPO:"TP_STRING",MAXLENGTH:100,NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"nombre",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            email: {TIPO:"TP_EMAIL",MAXLENGTH:150,NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"email",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            password: {TIPO:"TP_PASSWORD",VISIBILIDAD:"TP_VISIBLE_FORM",LABEL:1,NOMBRE:"contraseña",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",HELP:"SOLO PARA EDICIÓN - para no cambiar la contraseña, deje el campo vacío"},
        },
        FORM: [
            {
                '<div class="col-12 col-md">/name/</div><div class="col-12 col-md-6">/username/</div>' : [ 'name' , 'username' ]
            },
            {
                '<div class="col-12 col-md">/email/</div><div class="col-12 col-md-6">/password/</div>' : [ 'email' , 'password' ]
            }
        ]
    },
    /**********************************
            DATOS DE LA EMPRESA        
     ********************************** */
    usuarios: {
        ATRIBUTOS: {
            username: {TIPO:"TP_STRING",MAXLENGTH:30,NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"usuario",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            name: {TIPO:"TP_STRING",MAXLENGTH:100,NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"nombre",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            password: {TIPO:"TP_PASSWORD",VISIBILIDAD:"TP_VISIBLE_FORM",LABEL:1,NOMBRE:"contraseña",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0",HELP:"SOLO PARA EDICIÓN - para no cambiar la contraseña, deje el campo vacío"},
            is_admin: {TIPO:"TP_ENUM",VISIBILIDAD:"TP_VISIBLE",ENUM:{1:"Administrador",0:"Usuario"},NOMBRE:"Tipo",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0 text-uppercase",COMUN:1, NECESARIO: 1},
            login: {TIPO:"TP_FECHA",VISIBILIDAD:"TP_VISIBLE_TABLE",NOMBRE:"último ingreso",FORMAT:"{day}/{month}/{year} {hour}:{minute}:{second}"},
        },
        FORM: [
            {
                '<div class="col-12 col-md-6">/is_admin/</div>' : ['is_admin',]
            },
            {
                '<div class="col-12">/name/</div>' : [ 'name' ]
            },
            {
                '<div class="col-12 col-md-6">/username/</div><div class="col-12 col-md-6">/password/</div>' : ['username','password']
            }
        ]
    },
    imagen: {
        ATRIBUTOS: {
            image: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - (?)px x (?)px",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"imagen",WIDTH:"150px"},
        },
        FORM: [
            {
                '<div class="col-12 col-md-8">/image/</div>' : ['image']
            }
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        },
    },
    terminos: {
        ATRIBUTOS: {
            title: {TIPO:"TP_STRING",LABEL: 1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            text: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE",FIELDSET:1,NOMBRE:"texto",HELP:'Términos y condiciones de ejemplo sacado de <a href="https://terminosycondicionesdeusoejemplo.com/" target="_blank" rel="noopener noreferrer" class="text-primary">https://terminosycondicionesdeusoejemplo.com/ <i class="fas fa-external-link-alt ml-1"></i></a>'}
        },
        FORM: [
            {
                '<div class="col-12">/title/</div><div class="col-12 mt-2">/text/</div>' : ['title','text']
            }
        ],
        EDITOR: {
            text: {
                toolbarGroups: [
                    { name: 'document', groups : [ 'mode' , 'document' , 'doctools' ] },
                    { name: 'basicstyles', groups : [ 'basicstyles' ] },
                    { name: 'clipboard', groups : [ 'clipboard' , 'undo' ] },
                    { name: 'links' },
                    { name: 'colors', groups: [ 'TextColor' , 'BGColor' ] },
                ],
                removeButtons: 'Save,NewPage,Print,Preview,Templates',
                colorButton_colors : colorPick,
                height : '350px'
            },
        }
    },
    empresa_captcha: {
        ATRIBUTOS: {
            public: {TIPO:"TP_STRING",LABEL: 1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"clave pública",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            private: {TIPO:"TP_STRING",LABEL: 1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"clave secreta",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
        },
        FORM: [
            {
                '<div class="col-12 col-md">/public/</div><div class="col-12 col-md">/private/</div>' : ['public','private']
            }
        ]
    },
    metadatos: {
        ATRIBUTOS: {
            seccion: {TIPO:"TP_STRING",VISIBILIDAD:"TP_VISIBLE_TABLE",CLASS:"text-uppercase",NOMBRE:"sección"},
            keywords: {TIPO:"TP_TEXT",VISIBILIDAD:"TP_VISIBLE",FIELDSET:1,NOMBRE:"Palabras", CLASS:"rounded-0",HELP:"Separa elementos con coma (,)"},
            description: {TIPO:"TP_TEXT",VISIBILIDAD:"TP_VISIBLE",FIELDSET:1,NOMBRE:"descripción", CLASS:"rounded-0"}
        },
        FORM: [
            {
                '/seccion/<div class="d-flex col-3 col-md-3">/BTN/</div>' : ['BTN','seccion']
            },
            {
                '<div class="col-12">/description/</div><div class="col-12 mt-2">/keywords/</div>' : ['description','keywords']
            }
        ]
    },
    redes: {
        ATRIBUTOS: {
            redes: {TIPO:"TP_ENUM",LABEL:1,ENUM:{facebook:'Facebook',instagram:'Instagram',twitter:'Twitter',youtube:'YouTube',linkedin:'LinkedIn',pinterest:'Pinterest'},NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase border-left-0 border-right-0 border-top-0",NOMBRE:"red social",COMUN:1},
            titulo: {TIPO:"TP_STRING",LABEL: 1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
            url: {TIPO:"TP_LINK",LABEL: 1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"link del sitio",CLASS:"border-left-0 border-right-0 border-top-0 rounded-0"},
        },
        FORM: [
            {
                '<div class="col-12 col-md-6 col-lg-6">/redes/</div>' : ['redes']
            },
            {
                '<div class="col-12 col-md-10 col-lg-9">/titulo/</div>' : ['titulo']
            },
            {
                '<div class="col-12 col-md-10 col-lg-9">/url/</div>': ['url']
            }
        ],
        PADRE: "empresa"
    },
    empresa_email: {
        ATRIBUTOS: {
            email: {TIPO:"TP_EMAIL",LABEL:1,MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"}
        },
        FORM: [
            {
                '<div class="col-12">/email/</div>' : ['email']
            }
        ]
    },
    empresa_telefono: {
        ATRIBUTOS: {
            telefono: {TIPO:"TP_PHONE",LABEL:1,MAXLENGTH:50,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"número",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0",HELP:"Contenido oculto en el HREF. Solo números"},
            tipo: {TIPO:"TP_ENUM",ENUM:{tel:"Teléfono/Celular",wha:"Whatsapp"},NECESARIO:1,VISIBILIDAD:"TP_VISIBLE_FORM",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0 text-uppercase",NOMBRE:"Tipo",COMUN: 1},
            visible: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:50,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"elemento visible",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0",HELP:"Contenido visible. En caso de permanecer vacío, se utilizará el primer campo"},
            texto: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:50,VISIBILIDAD:"TP_VISIBLE",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0",HELP:"Texto que acompaña al elemento"},
            is_link: {TIPO:"TP_CHECK",VISIBILIDAD:"TP_VISIBLE",CHECK:"¿Es clickeable?"},
        },
        FORM: [
            {
                '<div class="col-12 col-md-6">/tipo/</div><div class="col-12 mt-3">/telefono/</div>' : ['tipo','telefono']
            },
            {
                '<div class="col-12">/visible/</div>':['visible']
            },
            {
                '<div class="col-12">/texto/</div>':['texto']
            },
            {
                '<div class="col-12 d-flex justify-content-between">/is_link/</div>':['is_link']
            }
        ]
    },
    empresa_domicilio: {
        ATRIBUTOS: {
            calle: {TIPO:"TP_STRING",LABEL:1,VISIBILIDAD:"TP_VISIBLE",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            altura: {TIPO:"TP_ENTERO",LABEL:1,VISIBILIDAD:"TP_VISIBLE",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            localidad: {TIPO:"TP_STRING",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"localidad",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            provincia: {TIPO:"TP_STRING",LABEL:1,VISIBILIDAD:"TP_VISIBLE",DEFAULT:"Buenos Aires",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            pais: {TIPO:"TP_STRING",LABEL:1,VISIBILIDAD:"TP_VISIBLE",DEFAULT:"Argentina",NOMBRE:"país",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            cp: {TIPO:"TP_STRING",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"código postal",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            detalle: {TIPO:"TP_STRING",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"detalles",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            mapa: {TIPO:"TP_TEXT",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"ubicación de Google Maps",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"},
            link: {TIPO:"TP_TEXT",LABEL:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"enlace de Google Maps",CLASS:"bg-transparent border-top-0 border-left-0 border-right-0 rounded-0"}
        },
        FORM: [
            {
                '<div class="col-12 col-md-8">/calle/</div><div class="col-12 col-md-4">/altura/</div>' : ['calle','altura'],
            },
            {
                '<div class="col-12 col-md-6">/cp/</div><div class="col-12 col-md-6">/pais/</div>' : ['cp','pais']
            },
            {
                '<div class="col-12 col-md-6">/provincia/</div><div class="col-12 col-md-6">/localidad/</div>' : ['provincia','localidad']
            },
            {
                '<div class="col-12 col-md">/detalle/</div>' : ['detalle']
            },
            {
                '<div class="col-12"><div class="alert alert-primary" role="alert">Copie de <a class="text-dark" href="https://www.google.com/maps" target="blank"><strong>Google Maps</strong> <i class="fas fa-external-link-alt"></i></a> la ubicación de la Empresa <i class="fas fa-share-alt"></i> / Insertar mapa / iFrame</div>/mapa/</div>' : ['mapa']
            },
            {
                '<div class="col-12"><div class="alert alert-warning" role="alert">Copie de <a class="text-dark" href="https://www.google.com/maps" target="blank"><strong>Google Maps</strong> <i class="fas fa-external-link-alt"></i></a> la ubicación de la Empresa <i class="fas fa-share-alt"></i> / Enlace para compartir</div>/link/</div>' : ['link']
            }
        ]
    },
    empresa_images: {
        ATRIBUTOS: {
            logo: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"",INVALID:"315px X 86px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"logotipo Header",WIDTH:"315px"},
            logoFooter: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"",INVALID:"276px X 74px",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/*",NOMBRE:"logotipo footer",WIDTH:"276px"},
            favicon: {TIPO:"TP_IMAGE",NECESARIO:1,VALID:"",INVALID:"",BROWSER:"",VISIBILIDAD:"TP_VISIBLE",ACCEPT:"image/x-icon,image/png",NOMBRE:"favicon",WIDTH:"70px"},
        },
        FORM: [
            {
                '<div class="col-12 col-md-4">/logo/</div><div class="col-12 col-md-4">/logoFooter/</div><div class="col-12 col-md-4">/favicon/</div>' : ['logo','logoFooter','favicon']
            }
        ],
        FUNCIONES: {
            logo: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
            logoFooter: {onchange:{F:"readURL(this,'/id/')",C:"id"}},
            favicon: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    empresa_text: {
        ATRIBUTOS: {
            text_contact: {TIPO:"TP_TEXT",FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"Contacto"}
        },
        FORM: [
            {
                '<div class="col-12">/text_contact/</div>' : ['text_contact']
            }
        ],
        EDITOR: {
            text_contact: {
                toolbarGroups: [
                    { name: 'clipboard', groups : [ 'clipboard' , 'undo' ] },
                    { name: 'links' },
                    { name: 'colors', groups: [ 'TextColor' , 'BGColor' ] },
                ],
                removeButtons: 'Save,NewPage,Print,Preview,Templates',
                colorButton_colors : colorPick,
                height : '150px'
            },
        }
    },
};