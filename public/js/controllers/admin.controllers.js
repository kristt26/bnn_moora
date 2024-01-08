angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('periodeController', periodeController)
    .controller('kriteriaController', kriteriaController)
    .controller('clientController', clientController)
    .controller('penilaianController', penilaianController)
    .controller('hasilController', hasilController)
    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Dashboard");
    $scope.datas = {};
    $scope.title = "Dashboard";
    // dashboardServices.get().then(res=>{
    //     $scope.datas = res;
    // })
}

function periodeController($scope, periodeServices, pesan, helperServices) {
    $scope.setTitle = "Periode";
    $scope.$emit("SendUp", $scope.setTitle);
    $scope.datas = {};
    $scope.model = {};
    periodeServices.get().then((res) => {
        $scope.datas = res;
    })
    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                periodeServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                periodeServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
        document.getElementById("periode").focus();
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            klasifikasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }

    $scope.subKlasifikasi = (param) => {
        document.location.href = helperServices.url + "admin/sub_klasifikasi/data/" + param.id;
    }
}

function kriteriaController($scope, kriteriaServices, pesan, helperServices, RangeServices) {
    $scope.setTitle = "Kriteria";
    $scope.$emit("SendUp", $scope.setTitle);
    $scope.datas = {};
    $scope.model = {};
    kriteriaServices.get().then((res) => {
        $scope.datas = res;
    })
    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                kriteriaServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                kriteriaServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        item.bobot = parseInt(item.bobot);
        $scope.model = angular.copy(item);
        // document.getElementById("nama").focus();
    }

    $scope.showRange = (param) => {
        $.LoadingOverlay("show");
        setTimeout(() => {
            $.LoadingOverlay("hide");
            $scope.$applyAsync(x => {
                $scope.kriteria = param;
                $scope.model.kriteria_id = $scope.kriteria.id;
                $scope.setTitle = "Range";
            })
        }, 200);
    }

    $scope.saveRange = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                RangeServices.put($scope.model).then(res => {
                    var data = $scope.kriteria.range.find(x=>x.id ==$scope.model.id);
                    if(data){
                        data.range = $scope.model.range;
                        data.bobot = $scope.model.bobot;
                    }
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                RangeServices.post($scope.model).then(res => {
                    $scope.model.id = res;
                    $scope.kriteria.range.push($scope.model);
                    $scope.model = {};
                    $scope.model.kriteria_id = $scope.kriteria.id;
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            kriteriaServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
    $scope.deleteRange = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            RangeServices.deleted(param).then(res => {
                var index = $scope.kriteria.range.indexOf(param);
                $scope.kriteria.range.splice(index, 1);
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
    $scope.back = () => {
        $.LoadingOverlay("show");
        setTimeout(() => {
            $.LoadingOverlay("hide");
            $scope.$applyAsync(x => {
                $scope.kriteria = {};
                $scope.setTitle = "Kriteria";
            })
        }, 200);
    }
}

function clientController($scope, clientServices, pesan, helperServices) {
    $scope.setTitle = "Client";
    $scope.$emit("SendUp", $scope.setTitle);
    $scope.datas = {};
    $scope.model = {};
    clientServices.get().then((res) => {
        $scope.datas = res;
    })
    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                clientServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                clientServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
        document.getElementById("periode").focus();
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            clientServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}

function penilaianController($scope, penilaianServices, pesan, helperServices) {
    $scope.setTitle = "Penilaian";
    $scope.$emit("SendUp", $scope.setTitle);
    $scope.datas = {};
    $scope.model = {};
    $scope.setShow = "client";
    penilaianServices.get().then((res) => {
        $scope.datas = res;
    })
    $scope.nilai = (param)=>{
        $scope.peserta = angular.copy(param);
        penilaianServices.getNilai(param.id).then(res=>{
            console.log(res);
            console.log($scope.peserta);
            $scope.model = {};
            $scope.model.kriteria = res;
            $scope.model.client = $scope.peserta;
            if($scope.peserta.statusNilai){
                $scope.model.kriteria.forEach(element => {
                    element.value = element.sub.find(x=>x.bobot==element.nilai);
                });
            }
            $scope.setShow = "penilaian";
        })
    }
    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.peserta.statusNilai) {
                penilaianServices.put($scope.model).then(res => {
                    $scope.model = {};
                    $scope.setShow = "client";
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                penilaianServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                    $scope.setShow = "client";
                    var item = $scope.datas.find(x=>x.id==$scope.peserta.id);
                    item.statusNilai = "2";
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
        document.getElementById("periode").focus();
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            penilaianServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
    $scope.back = ()=>{
        $scope.setShow = "client";
    }
}

function hasilController($scope, hasilServices, pesan, helperServices) {
    $scope.setTitle = "Penilaian";
    $scope.$emit("SendUp", $scope.setTitle);
    $scope.datas = {};
    $scope.model = {};
    $scope.setShow = "client";
    hasilServices.get().then((res) => {
        $scope.datas = res;
        console.log(res);
    })
}
