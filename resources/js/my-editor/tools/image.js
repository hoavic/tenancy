export default class ImageTool {



    //new image assign to Main
    create(main) {

        let figure = document.createElement('figure');
        let uploadPanel = document.createElement('div');
        uploadPanel.
  
        figure.classList.add('me-block', 'me-tool','me-image');
        figure.setAttribute('data-placeholder','Tiêu đề');

        this.main.appendChild(figure);
        this.keydownAction(figure);

        this.ExtraFunc.focusAction(figure, this.inlinetool);
    }
}