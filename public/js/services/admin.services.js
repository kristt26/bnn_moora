angular.module('admin.service', [])
    // admin
    .factory('dashboardServices', dashboardServices)
    .factory('periodeServices', periodeServices)
    .factory('kriteriaServices', kriteriaServices)
    .factory('RangeServices', RangeServices)
    .factory('clientServices', clientServices)
    .factory('penilaianServices', penilaianServices)
    .factory('hasilServices', hasilServices)
    ;

function dashboardServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'home/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        getLayanan:getLayanan
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getLayanan() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'get_layanan',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }
}

function periodeServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'periode/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                param.id = res.data;
                if(param.status=='1'){
                    service.data.forEach(element => {
                        if(element.status=='1') element.status='0';
                    });
                }
                service.data.push(param);
                def.resolve(param);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.periode = param.periode;
                    data.status = param.status;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function kriteriaServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'kriteria/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                param.id = res.data;
                service.data.push(param);
                def.resolve(param);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.kode = param.kode;
                    data.bobot = param.bobot;
                    data.type = param.type;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.error(err.data.message)
            }
        );
        return def.promise;
    }

}


function RangeServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'range/';
    var service = {};
    service.data = [];
    return {
        post: post,
        put: put,
        deleted: deleted
    };

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function clientServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'client/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                param.id = res.data;
                if(param.status=='1'){
                    service.data.forEach(element => {
                        if(element.status=='1') element.status='0';
                    });
                }
                service.data.push(param);
                def.resolve(param);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.jk = param.jk;
                    data.alamat = param.alamat;
                    data.telp = param.telp;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function penilaianServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'penilaian/';
    var service = {};
    service.data = [];
    return {
        get: get,
        getNilai: getNilai,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getNilai(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'getNilai/' + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                param.id = res.data;
                if(param.status=='1'){
                    service.data.forEach(element => {
                        if(element.status=='1') element.status='0';
                    });
                }
                service.data.push(param);
                def.resolve(param);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.jk = param.jk;
                    data.alamat = param.alamat;
                    data.telp = param.telp;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function hasilServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'hasil/';
    var service = {};
    return {
        get: get
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'hitung',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                pesan.dialog("Client belum selesai dinilai!").then(x=>{
                    document.location.href = helperServices.url + 'penilaian';
                });
                def.reject(err);
            }
        );
        return def.promise;
    }
}

