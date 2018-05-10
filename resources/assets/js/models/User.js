import Model from './Model.js';
import Role from './Role.js';

export default class User extends Model {

    constructor(args = {}) {
        super({
            'id'         : args.id,
            'name'       : args.name,
            'email'      : args.email,
            'picture'    : args.picture,
            'country'    : args.country,
            'about'      : args.about,
            'created_at' : args.created_at,
            'updated_at' : args.updated_at,
    });

        this.roles = Role.collect(args.roles);
        this.posts_count = args.posts_count;

        this.http.defaults.baseURL += 'user/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    setRoles(args = {}) {
        return this.http
            .put(this.data.id + '/role', {params : args})
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    resetPassword(args = {}) {
        return this.http
            .put(this.data.id + '/password/reset', {params : args})
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('user')
            .get(null, {params : args})
            .then((response) => {
                response.data = User.collect(response.data);
                return response.data;
            });
    }

    /**
     * @return bool
    */
    static isLoggedIn(args = {}) {
        if(Laravel.currentUser) {
            return true;
        }
        return false;
    }

    /**
     *  Get current user
     *  from Laravel.user
     *
     * @return User object
     */
    getCurrent() {
        this._setAttributes(Laravel.currentUser);
    }

    /**
     *  Get current user
     *  from Laravel.user
     *
     * @return User object
     */
    static getCurrent(){
        let user = new User();
        user.getCurrent();
        return user;
    }

    /**
     *  Check if use has role
     *
     * @param string
     *
     * @return bool
     */
    static hasRole(role){
        let user = new User();
        user.getCurrent();
        let hasRole = false;
        user.data.roles.forEach(user_role => {
            if(user_role.name == role) {
                hasRole = true;
            }
        });
        return hasRole;
    }


}
