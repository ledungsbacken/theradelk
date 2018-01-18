import Model from './Model.js';

export default class Post extends Model {

    constructor(args = {}) {
        super({
            'id'         : args.id,
            'user_id'    : args.user_id,
            'title'      : args.title,
            'content'    : args.content,
            'published'  : args.published,
            'deleted'    : args.deleted,
            'created_at' : args.created_at,
            'updated_at' : args.updated_at,
    });

        this.http.defaults.baseURL += 'post/';
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
    static index(args = {}) {
        return super._createAxios('post')
            .get(null, {params : args})
            .then((response) => {
                response.data.data = Post.collect(response.data.data);
                return response.data;
            });
    }




}
