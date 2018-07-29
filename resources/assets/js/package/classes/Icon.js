import icons from './../utils/icons';

class Icon {
    get(key){
        return icons[key];
    }
}

export default new Icon();
