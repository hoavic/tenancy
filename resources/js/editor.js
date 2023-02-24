import EditorJS from '@editorjs/editorjs'; 
import Header from '@editorjs/header'; 
import List from '@editorjs/list'; 

import LinkTool from '@editorjs/link';
import RawTool from '@editorjs/raw';
import SimpleImage from '@editorjs/simple-image';

/* import ImageTool from '@editorjs/image'; */
import MyImageTool from './my-image-upload/my-image-upload';
/* const Quote = require('@editorjs/quote');
const Warning = require('@editorjs/warning');
const Delimiter = require('@editorjs/delimiter'); */

export default {
    callEditor(token) {
        const editor = new EditorJS({ 
            /** 
             * Id of Element that should contain the Editor 
             */ 
            holder: 'editorjs', 
        
           /*  inlineToolbar: ['link', 'marker', 'bold', 'italic'], */
            
            /** 
             * Available Tools list. 
             * Pass Tool's class or Settings object for each Tool you want to use 
             */ 
            tools: { 
                header: {
                    class: Header, 
                    inlineToolbar: true,
                    config: {
                        placeholder: 'Header'
                    },
                    shortcut: 'CMD+SHIFT+H'
                }, 
                list: { 
                    class: List, 
                    inlineToolbar: true 
                },
                linkTool: {
                    class: LinkTool,
                    config: {
                    endpoint: 'http://localhost:8008/fetchUrl', // Your backend endpoint for url data fetching,
                    }
                },
                raw: RawTool,
/*                 image: {
                    class: ImageTool,
                    config: {
                        additionalRequestHeaders: {
                            "X-CSRF-TOKEN": token
                        },
                        endpoints: {
                            byFile: "/web-admin/api/media", // Your backend file uploader endpoint
                            byUrl: "http://localhost:8008/fetchUrl", // Your endpoint that provides uploading by Url
                        }
                    }
                } */
                image: MyImageTool,
            },
        
        
            /**
             * onChange callback
             */
            onChange: (api, event) => {
            console.log('Now I know that Editor\'s content changed!', event)
            },
        
            placeholder: 'Let`s write an awesome story!',
        
            autofocus: true
        });
    
    /*     function savePost() {
            editor.save().then((outputData) => {
                console.log('Article data: ', outputData)
            }).catch((error) => {
                console.log('Saving failed: ', error)
            });
        } */
    },
    EditorJS
}