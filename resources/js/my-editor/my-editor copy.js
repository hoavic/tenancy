class MyEditor {

    container;

    editor = document.createElement('div');

    main = document.createElement('div');

    toolbar = document.createElement('div');

    inlinetool = document.createElement('div');

    overlay = document.createElement('div');



    constructor(container_id) {
        this.container = document.getElementById(container_id);
    }

    setFrame() {

        this.main.classList.add('my-editor__main');
        this.editor.appendChild(this.main);
    
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
    }

    echoDom = () => {
        console.log(this.container);
    }

    newParagraph() {
        let ele = document.createElement('p');
        ele.contentEditable = "true";
        ele.classList.add('me-block', 'me-tool', 'me-paragraph');
        ele.setAttribute('data-placeholder','Văn bản... Gõ / Để chọn block');

        this.main.appendChild(ele);
        ele.addEventListener('keypress', (event) => {
            if(event.key === "Enter") {
                event.preventDefault();
                this.newParagraph();
            }
        });

        this.focusAction(ele);
    }

/*     newParagraph() {
        let ele = document.createElement('p');
        ele.contentEditable = "true";
        ele.classList.add('me-tool', 'me-paragraph');
        ele.setAttribute('data-placeholder','Gõ / Để chọn block');

        let newBlock = this.blockTemplate(ele);

        this.main.appendChild(newBlock);
        ele.addEventListener('keypress', (event) => {
            if(event.key === "Enter") {
                event.preventDefault();
                this.newParagraph();
            }
        });

        ele.focus();
    } */

    newHeading(h) {
        let ele = document.createElement(h);
        ele.contentEditable = "true";
        ele.classList.add('me-block', 'me-tool','me-heading');
        ele.setAttribute('data-placeholder','Tiêu đề');

        this.main.appendChild(ele);
        ele.addEventListener('keypress', (event) => {
            if(event.key === "Enter") {
                event.preventDefault();
                this.newParagraph();
            }
        });

        this.focusAction(ele);
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

        this.toolbar.classList.add('flex', 'gap-2');

        //para
        let createPara = document.createElement('span');
        createPara.textContent = 'P';
        createPara.addEventListener('click', this.newParagraph.bind(this));
        this.toolbar.appendChild(createPara);

        //heading
        let createHeading = document.createElement('span');
        createHeading.textContent = 'H';
        createHeading.addEventListener('click', (e) => {
            this.newHeading('h2');
        });
        this.toolbar.appendChild(createHeading);
    }

    focusAction(ele) {
        try {
            let ce_blocks = this.main.querySelectorAll('.me-block');
            ce_blocks.forEach(ce_block => {
                ce_block.classList.remove('isFocus');
                this.inlinetool.removeAttribute('style');
            });
        } catch (e) {

        }

        ele.classList.add('isFocus');
        ele.focus();
    }

    showInlineTool() {

        let updown = document.createElement('div');
        updown.classList.add('updown');

        let up = document.createElement('span');
        up.classList.add('up');
        up.textContent = "Up";
        updown.appendChild(up);

        let down = document.createElement('span');
        down.classList.add('down');
        down.textContent = "Down";
        updown.appendChild(down);

        this.inlinetool.appendChild(updown);

        this.main.addEventListener('click', (e) => {
            let focus = e.target;

            this.focusAction(focus);

            let rect = focus.getBoundingClientRect();

            console.log(rect);

            this.inlinetool.style.top = rect.y + window.scrollY - rect.height - 60 + 'px';
            /* this.inlinetool.style.left = rect.left + window.scrollX + 'px'; */

/*             this.inlinetool.addEventListener('mouseover', (mve) => {
                focus.classList.add('isHover');
            });

            this.inlinetool.addEventListener('mouseout', (mue) => {
                let me_blocks = this.main.querySelectorAll('.me-block');
                me_blocks.forEach(me_block => {
                    me_block.classList.remove('isHover');
                });
            }); */

            up.addEventListener('click', (eu) => {
                this.move(focus, -1);
            }); 

            down.addEventListener('click', (ed) => {
                this.move(focus, 1);
            });


        }, false);

    }

    move(ele, direction) {
        let parent = ele.parentNode;
        if (direction === -1 && ele.previousElementSibling) {
            parent.insertBefore(ele, ele.previousElementSibling);
        } else if (direction === 1 && ele.nextElementSibling) {
            parent.insertBefore(ele, ele.nextElementSibling.nextElementSibling)
        }
    }


}

export default MyEditor