import Model from './Model.js';
import User from './User.js';
import Subcategory from './Subcategory.js';

export default class Image extends Model {

    constructor(args = {}) {
        super({
            'id'         : args.id,
            'url'        : args.url,
        });

        this.http.defaults.baseURL += 'image/';
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('post')
            .get(null, {params : args})
            .then((response) => {
                response.data.data = Image.collect(response.data.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new Image(response.data));
    }

    /**
    * Upload a file
    *
    * @param file file
    * @return $promise
    */
    store(file){
        let formData = new FormData();
        formData.append("file", file);
        return this.http().post(this.data.id + '/file', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Image(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new Image(response.data));
    }


}
