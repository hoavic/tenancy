import ExtraFunc from "./ExtraFunc";

import {livewire_hot_reload} from 'virtual:livewire-hot-reload'
livewire_hot_reload();

class MyEditor {

    container;

    editor = document.createElement('div');

    main = document.createElement('div');

    toolbar = document.createElement('div');
    toggle = document.createElement('span');
    toolbarMain = document.createElement('div');

    inlinetool = document.createElement('div');

    overlay = document.createElement('div');

    constructor(container_id) {
        this.container = document.getElementById(container_id);
        this.ExtraFunc = new ExtraFunc();
    }

    setFrame() {

        this.main.classList.add('my-editor__main');
        this.editor.appendChild(this.main);
    
        this.toggle.textContent = '+';
        this.toggle.classList.add('editor-toggle');
        this.toolbar.appendChild(this.toggle);
        this.toggle.addEventListener('click', (e) => {
            this.toolbarMain.classList.toggle('show');
        });

        this.toolbarMain.classList.add('toolbar-main');
        this.toolbar.appendChild(this.toolbarMain);
        this.toolbarMain.addEventListener('click', (e) => {
            try {
                this.toolbarMain.classList.remove('show');
            } catch (error) {}
        });

        this.toolbar.classList.add('my-editor__toolbar');
        this.editor.appendChild(this.toolbar);

        this.inlinetool.classList.add('my-editor__inlinetool');
        this.editor.appendChild(this.inlinetool);
    
        this.overlay.classList.add('my-editor__overlay');
        this.editor.appendChild(this.overlay);

        this.editor.classList.add('my-editor');
        this.container.appendChild(this.editor);

        this.newParagraph();

        this.showToolbar();
        this.showInlineTool();
        this.ExtraFunc.hoverAction(this.inlinetool);
    }

    newParagraph() {
        let ele = document.createElement('p');
        ele.contentEditable = "true";
        ele.classList.add('me-block', 'me-tool', 'me-paragraph');
        ele.setAttribute('data-placeholder','Văn bản... Gõ / Để chọn block');

        this.main.appendChild(ele);



        this.keydownAction(ele);

        this.ExtraFunc.focusAction(ele, this.inlinetool);
    }

    newHeading(h) {
        let ele = document.createElement(h);
        ele.contentEditable = "true";
        ele.classList.add('me-block', 'me-tool','me-heading');
        ele.setAttribute('data-placeholder','Tiêu đề');

        this.main.appendChild(ele);
        this.keydownAction(ele);

        this.ExtraFunc.focusAction(ele, this.inlinetool);
    }

    blockTemplate(ele) {
        let block = document.createElement('div');
        block.classList.add('me-block');

        let blockContent = document.createElement('div');
        blockContent.classList.add('me-block__content');

        blockContent.appendChild(ele);

        block.appendChild(blockContent);

        return block;
    }

    showToolbar() {

        //para
        let createPara = document.createElement('span');
        createPara.textContent = 'P';
        createPara.addEventListener('click', (e) => {
            e.preventDefault();
            this.newParagraph.bind(this)
        });
        this.toolbarMain.appendChild(createPara);

        //heading
        let createHeading = document.createElement('span');
        createHeading.textContent = 'H';
        createHeading.addEventListener('click', (e) => {
            e.preventDefault();
            this.newHeading('h2');
        });
        this.toolbarMain.appendChild(createHeading);
    }

    showInlineTool() {

        //updown
        let updown = document.createElement('div');
        updown.classList.add('updown');

        let up = document.createElement('button');
        up.classList.add('up');
        up.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16"> <path d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"/> </svg>';
        updown.appendChild(up);

        let down = document.createElement('button');
        down.classList.add('down');
        down.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"> <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/> </svg>';
        updown.appendChild(down);

        this.inlinetool.appendChild(updown);

        // text format

        let extra_tool = document.createElement('div');
        extra_tool.classList.add('extra_tool');

        let bold_button = document.createElement('button');
        bold_button.classList.add('bold_button');
        bold_button.textContent = "B";
        extra_tool.appendChild(bold_button);

        let italic_button = document.createElement('button');
        italic_button.classList.add('italic_button');
        italic_button.textContent = "I";
        extra_tool.appendChild(italic_button);

        bold_button.addEventListener('click', (eb) => {
            eb.preventDefault();
            this.ExtraFunc.toggleHtmlTag('strong');
            /* document.execCommand('bold'); */
        });

        italic_button.addEventListener('click', (eb) => {
            eb.preventDefault();
            this.ExtraFunc.toggleHtmlTag('em');
            /* document.execCommand('italic'); */
        });

        this.inlinetool.appendChild(extra_tool);
        
        this.main.addEventListener('click', (e) => {
           /*  console.log(e.target); */

            let me_blocks = this.main.querySelectorAll('.me-block');
            //remove focus
            this.ExtraFunc.removeFocus(this.inlinetool);

            me_blocks.forEach(block => {

                if(block === e.target || block.contains(e.target)) {

                    block.classList.add('isFocus');
    
                    this.ExtraFunc.setInlineToolPosition(block, this.inlinetool);
                    this.ExtraFunc.setToolbarPosition(block, this.toolbar);
    
                    /* console.log('e.target is block'); */
    
                    up.addEventListener('click', (eu) => {
                        eu.preventDefault();
                        this.ExtraFunc.moveBlock(block, -1, this.inlinetool);
                    }); 
        
                    down.addEventListener('click', (ed) => {
                        ed.preventDefault();
                        this.ExtraFunc.moveBlock(block, 1, this.inlinetool);
                    });

                }
            });

        });

    }


//keyboard action
    keydownAction(ele) {
        ele.addEventListener('keydown', (event) => {

            if(event.key === "Enter") {
                console.log('pressed Enter');      
                event.preventDefault();
                if (ele.nextSibling) {   
                    ele.nextSibling.focus();
                    return;
                }
                this.newParagraph();
                return;
            }

            if(event.key === "Backspace") {
                if (ele.parentNode.children.length == 1) {
                    return;
                }
                if (ele.childNodes.length === 0) {
                    /* console.log('pressed Backspace'); */
                    try {
                        event.preventDefault();
                        let prev = ele.previousSibling;
                        ele.remove();
                        this.setFocusToEnd(prev);
                    } catch (error) {
                        console.log(error);
                    }
                }
            }
        });

    }

    setFocusToEnd(element) {
        // Place cursor at the end of a content editable div
        if (element.type !== "textarea" && element.getAttribute("contenteditable") === "true") {
            element.focus()
            window.getSelection().selectAllChildren(element)
            window.getSelection().collapseToEnd()
        } else {
            // Place cursor at the end of text areas and input elements
            element.focus()
            element.select()
            window.getSelection().collapseToEnd()
        }
    }   

    getSelectedText() {
        let txt;
        if (window.getSelection) {
            txt = window.getSelection();
        } else if (window.document.getSelection) {
            txt =window.document.getSelection();
        } else if (window.document.selection) {
            txt = window.document.selection.createRange().text;
        }
        return txt;  
    }

    save() {
        let output = '';
        let elements = this.main.querySelectorAll('*');
        elements.forEach(element => {
            let elementClone = element.cloneNode(true);
            while (elementClone.attributes.length > 0) {
                elementClone.removeAttribute(elementClone.attributes[0].name);
            }
            output += elementClone.outerHTML;
            elementClone.remove();
        });
        /* return output */
        console.log(output);
        document.getElementById('content').innerHTML = output;
    }

}

export default MyEditor