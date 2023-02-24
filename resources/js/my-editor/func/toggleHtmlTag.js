function toggleHtmlTag(tag) {
    let sel, range, node;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = window.getSelection().getRangeAt(0);

            let docFragment = range.cloneContents();
            console.log(range);
            if (docFragment.querySelector(tag)) {
                let text = document.createTextNode('');
                docFragment.replaceChild(text, docFragment.querySelector(tag));
                return;
            }
            
            let html = '<' + tag + '>' + range + '</' + tag + '>';
            range.deleteContents();
            
            let el = document.createElement("div");
            el.innerHTML = html;
            let frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            range.insertNode(frag);
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.collapse(false);
        range.pasteHTML(html);
    }
}    

function  execBold() {

        let tag = document.createElement("strong");
        if (this.getSelectedText()) {
            let sel = this.getSelectedText();
            console.log(sel);
            if (sel.rangeCount) {
                let range = sel.getRangeAt(0).cloneRange();
                range.surroundContents(tag);
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
} 


function edit(tag) {
    // Getting selected text
    let selectedText = getSelection();
    
    // Create new element
    let el = document.createElement(tag);
    
    // Applying style depending on the format
    if (tag === 'STRONG') {
        // Assignation to retain previous style
        el.style.fontStyle = (textItalic? 'italic' : 'normal');
        if (textBold === false) {
            el.style.fontWeight = 'bold';
            textBold = true;
        } else {
            el.style.fontWeight = 'normal';
            textBold = false;
        }     
    }

    else if (format === 'EM') {
        // Assignation to retain previous style
        el.style.fontWeight = (textBold ? 'bold' : 'normal');
        if (textItalic === false) {
            el.style.fontStyle = 'italic';
            textItalic = true;
        } else {
            el.style.fontStyle = 'normal';
            textItalic = false;
        }
    }

    el.innerHTML = selectedText.toString();
    let range = selectedText.getRangeAt(0);
    range.deleteContents();
    range.insertNode(el);

}