import Model from './Model.js';
import User from './User.js';
import Subcategory from './Subcategory.js';

export default class HeadImage extends Model {

    constructor(args = {}) {
        super({
            'id'         : args.id,
            'user_id'    : args.user_id,
            'credits'    : args.credits,
            'thumbnail'  : args.thumbnail,
            'desktop'    : args.desktop,
            'tablet'     : args.tablet,
            'phone'      : args.phone,
            'created_at' : args.created_at,
            'updated_at' : args.updated_at,
        });

        this.http.defaults.baseURL += 'headimage/';
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('headimage')
            .get(null, {params : args})
            .then((response) => {
                response.data.data = HeadImage.collect(response.data.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new HeadImage(response.data));
    }

    /**
    * Upload a file
    *
    * @param file file
    * @return $promise
    */
    store(files){
        let formData = new FormData();
        formData.append("credits", files.credits);
        formData.append("thumbnail", files.thumbnail);
        formData.append("desktop", files.desktop);
        formData.append("tablet", files.tablet);
        formData.append("phone", files.phone);
        return this.http.post('upload', formData, {
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
            .then(response => new HeadImage(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new HeadImage(response.data));
    }


}
