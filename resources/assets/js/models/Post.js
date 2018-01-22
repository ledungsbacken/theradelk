import Model from './Model.js';
import User from './User.js';
import Subcategory from './Subcategory.js';

export default class Post extends Model {

    constructor(args = {}) {
        super({
            'id'         : args.id,
            'user_id'    : args.user_id,
            'title'      : args.title,
            'subtitle'   : args.subtitle,
            'content'    : args.content,
            'slug'       : args.slug,
            'hidden'     : args.hidden,
            'published'  : args.published,
            'deleted_at' : args.deleted_at,
            'created_at' : args.created_at,
            'updated_at' : args.updated_at,
        });

        this.subcategories = Subcategory.collect(args.subcategories);
        this.user = new User(args.user);

        this.http.defaults.baseURL += 'post/';
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('post')
            .get(null, {params : args})
            .then((response) => {
                response.data.data = Post.collect(response.data.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new Post(response.data));
    }

    /**
     * @return $promise
    */
    showBySlug() {
        return this.http
            .get('slug/'+this.data.slug)
            .then(response => new Post(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new Post(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Post(response.data));
    }

    /**
     * @return $promise
    */
    visibiltyStatus() {
        return this.http
            .put(this.data.id + '/visibilty', this.data)
            .then(response => new Post(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new Post(response.data));
    }

    /**
    * @return $promise
    */
    restoreDestroyed() {
        return this.http
        .put(this.data.id + '/restore')
        .then(response => new Post(response.data));
    }

    /**
    * @return $promise
    */
    hardDelete() {
        return this.http
        .delete(this.data.id + '/hard')
        .then(response => new Post(response.data));
    }

    /**
    * Upload a file
    *
    * @param file file
    * @return $promise
    */
    storeFile(file){
        let formData = new FormData();
        formData.append("file", file);
        return this.http().post(this.data.id + '/file', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }

    /**
     * List files
     *
     * @return {promise}
     */
    indexFiles() {
        return this.http()
            .get(this.data.id + '/file')
            .then(response => File.collect(response.data));
    }


}
