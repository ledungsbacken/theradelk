import Model from './Model.js';
import SocialLinkType from './SocialLinkType.js';

export default class SocialLink extends Model {

    constructor(args = {}) {
        super({
            'id'      : args.id,
            'user_id' : args.user_id,
            'type_id' : args.type_id,
            'url'     : args.url,
        });

        this.type = args.type ? new SocialLinkType(args.type) : undefined;

        this.http.defaults.baseURL += 'sociallink/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new SocialLink(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new SocialLink(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new SocialLink(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new SocialLink(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('sociallink')
            .get(null, {params : args})
            .then((response) => {
                response.data = SocialLink.collect(response.data);
                return response;
            });
    }



}