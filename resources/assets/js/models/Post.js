import Model from './Model.js';
import User from './User.js';
import Subcategory from './Subcategory.js';
import HeadImage from './HeadImage.js';

export default class Post extends Model {

    constructor(args = {}) {
        super({
            'id'            : args.id,
            'user_id'       : args.user_id,
            'head_image_id' : args.head_image_id,
            'title'         : args.title,
            'subtitle'      : args.subtitle,
            'content'       : args.content,
            'slug'          : args.slug,
            'opacity'       : args.opacity,
            'is_fullscreen' : args.is_fullscreen,
            'hidden'        : args.hidden,
            'published'     : args.published,
            'deleted_at'    : args.deleted_at,
            'created_at'    : args.created_at,
            'updated_at'    : args.updated_at,
            'views'         : args.views_count_relation ? args.views_count_relation.count : 0,
        });

        this.subcategories = Subcategory.collect(args.subcategories);
        this.user = new User(args.user);
        this.headImage = args.head_image ? new HeadImage(args.head_image) : new HeadImage();

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
    static indexByCategory(args = {}) {
        return super._createAxios('posts/category')
            .get(null, {params : args})
            .then((response) => {
                response.data = Post.collect(response.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    static indexAdmin(args = {}) {
        return super._createAxios('posts/admin')
            .get(null, {params : args})
            .then((response) => {
                response.data.data = Post.collect(response.data.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    show(args = {}) {
        return this.http
            .get(this.data.id.toString(), {params : args})
            .then(response => new Post(response.data));
    }

    /**
     * @return $promise
    */
    showBySlug(args = {}) {
        return this.http
            .get('slug/'+this.data.slug, {params : args})
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
    addView() {
        return this.http
            .post(this.data.id + '/add/view', this.data)
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
    setPublished() {
        return this.http
            .put(this.data.id + '/publish', this.data)
            .then(response => new Post(response.data));
    }

    /**
     * @return $promise
    */
    setHidden() {
        return this.http
            .put(this.data.id + '/hidden', this.data)
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
        .delete(this.data.id + '/delete/hard')
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
