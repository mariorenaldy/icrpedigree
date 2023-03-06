var suneditor = SUNEDITOR.create('rule', {
    font : [
        'Arial',
        'Tahoma',
        'Courier New, Courier'
    ],
    fontSize : [
        8, 10, 14, 18, 24, 36
    ],
    colorList : [
        ['#ccc', '#dedede', 'OrangeRed', 'Orange', 'RoyalBlue', 'SaddleBrown'],
        ['SlateGray', 'BurlyWood', 'DeepPink', 'FireBrick', 'Gold', 'SeaGreen'],
    ],
    mode: 'inline',
    display: 'block',
    width: '100%',
    height: '162',
    popupDisplay: 'full',
    buttonList: [
        ['font', 'fontSize', 'fontColor', 'bold', 'underline', 'italic', 'list', 'link', 'image', 'video', 'showBlocks']
    ],
    placeholder: 'Start typing something...'
});

function save(){
    suneditor.save();
}