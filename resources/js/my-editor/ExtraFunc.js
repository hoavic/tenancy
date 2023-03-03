class ExtraFunc {

    // dung cho Bold, Italic
    toggleHtmlTag(tag) {

        let sel, range;

        if (window.getSelection) {

            sel = window.getSelection();

            if (sel.getRangeAt && sel.rangeCount) {

                range = window.getSelection().getRangeAt(0);

                let parentNode = sel.focusNode.parentElement
                console.log('tagName:' + parentNode.tagName);

                let newChild;

                if (parentNode.tagName === tag.toUpperCase()) {

                    let textOnly = parentNode.textContent;
                    parentNode.outerHTML = textOnly;
                    
                } else {

                    newChild = document.createElement(tag);
                    newChild.textContent = range;
                    range.deleteContents();
                    range.insertNode(newChild);
                }
            }

            sel.removeAllRanges();

        } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            range.collapse(false);
            range.pasteHTML(html);
        }
    } 


    // set Position Inline to Focus
    setInlineToolPosition(focus, inlinetool) {
        let rect = focus.getBoundingClientRect();
        /* console.log(rect); */
        inlinetool.style.top = rect.top + window.scrollY - 90 + 'px';
        inlinetool.style.left = rect.left/2 + window.scrollX  - 15+ 'px';
    }

    setToolbarPosition(focus, toolbar) {
        let rect = focus.getBoundingClientRect();
        console.log(rect);
        toolbar.style.top = rect.y + window.scrollY - rect.height - 15 + 'px';
        toolbar.style.right = rect.x + 'px';
    }

    //moving block wwhen click up down
    moveBlock(block, direction, inlinetool) {
        let parent = block.parentNode;
        if (direction === -1 && block.previousElementSibling) {
            parent.insertBefore(block, block.previousElementSibling);
        } else if (direction === 1 && block.nextElementSibling) {
            parent.insertBefore(block, block.nextElementSibling.nextElementSibling)
        }
        this.setInlineTool(block, inlinetool);
    }

    // hover inlinetool and border target block
    hoverAction (inlinetool) {
        try {
            inlinetool.addEventListener('mouseover', (e) => {
                let isFocus = document.querySelector('.isFocus');
                isFocus.classList.add('isHover');
            });

            inlinetool.addEventListener('mouseout', (e) => {
                try {
                    let isFocus = document.querySelector('.isHover');
                    isFocus.classList.remove('isHover');
                } catch (error) {
                    
                }

            });
        } catch (error) {}
    }

    // add isFocus class to tarrget block

    focusAction(targetBlock, inlinetool) {

        this.removeFocus(inlinetool);

        targetBlock.classList.add('isFocus');
        targetBlock.click();
        targetBlock.focus();

    }

    removeFocus(inlinetool) {
        try {
            let isFocus = document.querySelector('.isFocus');
            isFocus.classList.remove('isFocus');
            inlinetool.removeAttribute('style');
        } catch (ex) {}

/*         try {
            let blocks = document.querySelectorAll('.me-block');
            blocks.forEach(block => {
                block.classList.remove('isFocus');
                inlinetool.removeAttribute('style');
            });
        } catch (e) {} */
    }

}

export default ExtraFunc