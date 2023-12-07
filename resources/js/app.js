import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import { ZiggyVue } from 'ziggyVue';
import { Ziggy } from './ziggy';
import route from 'ziggy-js'
import {ref, watch, watchEffect} from 'vue';
import { reactive } from "vue";
import {useMagicKeys, whenever} from "@vueuse/core";
import alertify from 'alertifyjs';
window.alertify = alertify;

const { shift_x } = useMagicKeys({
    passive: false,
    onEventFired(e) {
        if (e.shiftKey && e.key === 'x' && e.type === 'keyup') {
            e.preventDefault()
        }
    }
});
const { shift_d } = useMagicKeys({
    passive: false,
    onEventFired(e) {
        if (e.shiftKey && e.key === 'd' && e.type === 'keyup') {
            e.preventDefault()
        }
    }
});

const app = createApp({
    setup: function () {
        return {
            loading: false,
            FileViewType: ref("folder"),
            SavedFiles: ref([]),
            AllFiles: ref([]),
            filename: ref(""),
            download: reactive({"name": "", "file": ""}),
            FileBrowserType: ref(null),
            ExcelSeatTable: ref(null),
            development: {
                "land_use": "",
                "area": 0,
                "runoff_c": 0,
                "impervious": 0
            },
            TablesData: ref({
                "timeUnit": "60",
                "PreDevelopment": [{
                    "land_use": "",
                    "area": 0,
                    "runoff_c": 0,
                    "impervious": 0
                }],
                "PostDevelopment": [{
                    "land_use": "",
                    "area": 0,
                    "runoff_c": 0,
                    "impervious": 0
                }],
                "TotalSiteArea": {
                    "pre": {
                        "area": 0,
                        "runoff_c": 0,
                        "impervious": 0,
                        "toc": 0
                    },
                    "post": {
                        "area": 0,
                        "runoff_c": 0,
                        "impervious": 0,
                        "toc": 0
                    },
                    "allowedScenario": {
                        "area": 0,
                        "runoff_c": 0,
                        "impervious": 0,
                        "toc": 0
                    },
                },
                "Idf": {
                    "A": {
                        "hiddenColumn": 0,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0,
                    },
                    "B": {
                        "hiddenColumn": 0,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "D": {
                        "hiddenColumn": 0,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "m10": {
                        "hiddenColumn": 0.17,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "m15": {
                        "hiddenColumn": 0.25,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "m30": {
                        "hiddenColumn": 0.5,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "h1": {
                        "hiddenColumn": 1,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "h2": {
                        "hiddenColumn": 2,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "h6": {
                        "hiddenColumn": 6,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "h12": {
                        "hiddenColumn": 12,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "h24": {
                        "hiddenColumn": 24,
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                },
                "Mcr_a": {
                    "pre": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "post": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "allowedScenario": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    }
                },
                "Mci_b": {
                    "pre": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "post": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "allowedScenario": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    }
                },
                "Mc": {
                    "pre": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "post": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "allowedScenario": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    }
                },
                "I": {
                    "pre": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "post": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "allowedScenario": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    }
                },
                "Q_l": {
                    "pre": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "post": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "allowedScenario": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    }
                },
                "Q_m": {
                    "pre": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "post": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    },
                    "allowedScenario": {
                        "2": 0,
                        "5": 0,
                        "10": 0,
                        "25": 0,
                        "50": 0,
                        "100": 0
                    }
                },
                "Drp": "2",
                "Pd_c": 0,
                "Maq": 0,
                "Area": 0,
                "Toc": 0,
                "Mi_r": 0,
                "StorageTable": {
                    "10": {
                        "T": 10,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "20": {
                        "T": 20,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "30": {
                        "T": 30,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "40": {
                        "T": 40,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "50": {
                        "T": 50,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "60": {
                        "T": 60,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "70": {
                        "T": 70,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "80": {
                        "T": 80,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "90": {
                        "T": 90,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "100": {
                        "T": 100,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "110": {
                        "T": 110,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "120": {
                        "T": 120,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "130": {
                        "T": 130,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "140": {
                        "T": 140,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "150": {
                        "T": 150,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "160": {
                        "T": 160,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "170": {
                        "T": 170,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                    "180": {
                        "T": 180,
                        "I": 0,
                        "Ix": 0,
                        "Pdq": 0,
                        "TraAv": 0,
                        "TriAv": 0,
                        "Sv": 0
                    },
                },
                MaxStorage: ref(0)
            }),
            IdfKeys: ref(["2", "5", "10", "25", "50", "100"]),
            StorageCalcKeys: ref(["10", "20", "30", "40", "50", "60", "70", "80", "90", "100", "110", "120", "130", "140", "150", "160", "170", "180"])
        }
    },
    mounted() {
        const self = this;
        window.onload = () => {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
            whenever(shift_x, () => {
                const preDevelop = $("#collapseOne");
                const postDevelop = $("#collapseTwo");
                if (preDevelop.hasClass("show")){
                    self.TablesData.PreDevelopment.push({
                        "land_use" : "",
                        "area" : 0,
                        "runoff_c": 0,
                        "impervious": 0
                    });
                }
                else if (postDevelop.has("show")){
                    self.TablesData.PostDevelopment.push({
                        "land_use" : "",
                        "area" : 0,
                        "runoff_c": 0,
                        "impervious": 0
                    });
                }
            });
            whenever(shift_d, () => {
                const preDevelop = $("#collapseOne");
                const postDevelop = $("#collapseTwo");
                if (preDevelop.hasClass("show")){
                    self.TablesData.PreDevelopment.splice(this.TablesData.PreDevelopment.length - 1,1);
                }
                else if (postDevelop.has("show")){
                    self.TablesData.PostDevelopment.splice(this.TablesData.PostDevelopment.length - 1,1);
                }
            });
        };
        watchEffect(() => {
            if (self.TablesData.PreDevelopment.length === 0)
                self.TablesData.PreDevelopment.push(self.development);
            if (self.TablesData.PostDevelopment.length === 0)
                self.TablesData.PostDevelopment.push(self.development);
            //PreDevelopment table
            let area_sum = 0;
            let runoff_c_sum = 0;
            let impervious_sum = 0;
            self.TablesData.PreDevelopment.forEach(item => {
                const area = !isNaN(parseFloat(item.area)) ? parseFloat(item.area) :  0;
                const runoff_c = !isNaN(parseFloat(item.runoff_c)) ? parseFloat(item.runoff_c) : 0;
                const impervious = !isNaN(parseFloat(item.impervious)) ? parseFloat(item.impervious) : 0;
                area_sum += area;
                runoff_c_sum += runoff_c * area;
                impervious_sum += impervious * area;
            });
            self.TablesData.TotalSiteArea.pre.area = area_sum !== 0 ? area_sum.toFixed(2) : 0;
            self.TablesData.TotalSiteArea.pre.runoff_c = runoff_c_sum !== 0 ? (runoff_c_sum / area_sum).toFixed(2) : 0;
            self.TablesData.TotalSiteArea.pre.impervious = impervious_sum !== 0 ? (impervious_sum / area_sum).toFixed(1) + "%" : 0 + "%";
            //PostDevelopment table
            area_sum = 0;
            runoff_c_sum = 0;
            impervious_sum = 0;
            self.TablesData.PostDevelopment.forEach(item => {
                const area = !isNaN(parseFloat(item.area)) ? parseFloat(item.area) :  0;
                const runoff_c = !isNaN(parseFloat(item.runoff_c)) ? parseFloat(item.runoff_c) : 0;
                const impervious = !isNaN(parseFloat(item.impervious)) ? parseFloat(item.impervious) : 0;
                area_sum += area;
                runoff_c_sum += runoff_c * area;
                impervious_sum += impervious * area;
            });
            self.TablesData.TotalSiteArea.post.area = area_sum !== 0 ? area_sum.toFixed(2) : 0;
            self.TablesData.TotalSiteArea.post.runoff_c = runoff_c_sum !== 0 ? (runoff_c_sum / area_sum).toFixed(2) : 0;
            self.TablesData.TotalSiteArea.post.impervious = impervious_sum !== 0 ? (impervious_sum / area_sum).toFixed(1) + "%" : 0 + "%";
            self.IdfKeys.forEach(key => {
                if (!isNaN(parseFloat(self.TablesData.Idf.A[key])) && !isNaN(parseFloat(self.TablesData.Idf.B[key])) && !isNaN(parseFloat(self.TablesData.Idf.D[key]))) {
                    self.TablesData.Idf.m10[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.m10["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.m15[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.m15["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.m30[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.m30["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.h1[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.h1["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.h2[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.h2["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.h6[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.h6["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.h12[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.h12["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    self.TablesData.Idf.h24[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow((parseFloat(self.TablesData.Idf.B[key]) + parseFloat(self.TablesData.Idf.h24["hiddenColumn"])), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                }
                //PreDevelopment
                if (!isNaN(parseFloat(self.TablesData.Mcr_a.pre[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.pre.runoff_c)) && !isNaN(parseFloat(self.TablesData.Mci_b.pre[key])))
                    self.TablesData.Mc.pre[key] = (parseFloat(self.TablesData.Mcr_a.pre[key]) * parseFloat(self.TablesData.TotalSiteArea.pre.runoff_c) + parseFloat(self.TablesData.Mci_b.pre[key])).toFixed(2);
                if (self.TablesData.TotalSiteArea.pre.toc > 0) {
                    if (!isNaN(parseFloat(self.TablesData.Idf.A[key])) && !isNaN(parseFloat(self.TablesData.Idf.B[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.pre.toc)) && !isNaN(parseFloat(self.TablesData.Idf.D[key])))
                        self.TablesData.I.pre[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow(parseFloat(self.TablesData.Idf.B[key]) + (parseFloat(self.TablesData.TotalSiteArea.pre.toc) / parseInt(self.TablesData.timeUnit)), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                }
                if (!isNaN(parseFloat(self.TablesData.Mc.pre[key])) && !isNaN(parseFloat(self.TablesData.I.pre[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.pre.area))) {
                    self.TablesData.Q_l.pre[key] = (2.78 * parseFloat(self.TablesData.Mc.pre[key]) * self.TablesData.I.pre[key] * (self.TablesData.TotalSiteArea.pre.area / 10000).toFixed(2)).toFixed(2);
                    self.TablesData.Q_m.pre[key] = (self.TablesData.Q_l.pre[key] / 1000).toFixed(3);
                }
                //PostDevelopment
                if (!isNaN(parseFloat(self.TablesData.Mcr_a.post[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.post.runoff_c)) && !isNaN(parseFloat(self.TablesData.Mci_b.post[key])))
                    self.TablesData.Mc.post[key] = (parseFloat(self.TablesData.Mcr_a.post[key]) * parseFloat(self.TablesData.TotalSiteArea.post.runoff_c) + parseFloat(self.TablesData.Mci_b.post[key])).toFixed(2);
                if (self.TablesData.TotalSiteArea.post.toc > 0) {
                    if (!isNaN(parseFloat(self.TablesData.Idf.A[key])) && !isNaN(parseFloat(self.TablesData.Idf.B[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.post.toc)) && !isNaN(parseFloat(self.TablesData.Idf.D[key])))
                        self.TablesData.I.post[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow(parseFloat(self.TablesData.Idf.B[key]) + (parseFloat(self.TablesData.TotalSiteArea.post.toc) / parseInt(self.TablesData.timeUnit)), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                }
                if (!isNaN(parseFloat(self.TablesData.Mc.post[key])) && !isNaN(parseFloat(self.TablesData.I.post[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.post.area))) {
                    self.TablesData.Q_l.post[key] = (2.78 * parseFloat(self.TablesData.Mc.post[key]) * self.TablesData.I.post[key] * (self.TablesData.TotalSiteArea.post.area / 10000).toFixed(2)).toFixed(2);
                    self.TablesData.Q_m.post[key] = (self.TablesData.Q_l.post[key] / 1000).toFixed(3);
                }
                //AllowedScenario
                if (self.TablesData.TotalSiteArea.allowedScenario.area > 0 && self.TablesData.TotalSiteArea.allowedScenario.runoff_c > 0 && self.TablesData.TotalSiteArea.allowedScenario.toc > 0) {
                    if (!isNaN(parseFloat(self.TablesData.Mcr_a.allowedScenario[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.allowedScenario.runoff_c)) && !isNaN(parseFloat(self.TablesData.Mci_b.allowedScenario[key])))
                        self.TablesData.Mc.allowedScenario[key] = (parseFloat(self.TablesData.Mcr_a.allowedScenario[key]) * parseFloat(self.TablesData.TotalSiteArea.allowedScenario.runoff_c) + parseFloat(self.TablesData.Mci_b.allowedScenario[key])).toFixed(2);
                    if (self.TablesData.TotalSiteArea.allowedScenario.toc > 0) {
                        if (!isNaN(parseFloat(self.TablesData.Idf.A[key])) && !isNaN(parseFloat(self.TablesData.Idf.B[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.allowedScenario.toc)) && !isNaN(parseFloat(self.TablesData.Idf.D[key])))
                            self.TablesData.I.allowedScenario[key] = (parseFloat(self.TablesData.Idf.A[key]) * (Math.pow(parseFloat(self.TablesData.Idf.B[key]) + (parseFloat(self.TablesData.TotalSiteArea.allowedScenario.toc) / parseInt(self.TablesData.timeUnit)), parseFloat(self.TablesData.Idf.D[key]))).toFixed(2)).toFixed(2);
                    }
                    if (!isNaN(parseFloat(self.TablesData.Mc.allowedScenario[key])) && !isNaN(parseFloat(self.TablesData.I.allowedScenario[key])) && !isNaN(parseFloat(self.TablesData.TotalSiteArea.allowedScenario.area))) {
                        self.TablesData.Q_l.allowedScenario[key] = (2.78 * parseFloat(self.TablesData.Mc.allowedScenario[key]) * self.TablesData.I.allowedScenario[key] * (self.TablesData.TotalSiteArea.allowedScenario.area)).toFixed(2);
                        self.TablesData.Q_m.allowedScenario[key] = (self.TablesData.Q_l.allowedScenario[key] / 1000).toFixed(3);
                    }
                }
            });
            self.StorageCalcKeys.forEach(key => {
                if (!isNaN(parseFloat(self.TablesData.Idf.A[self.TablesData.Drp])) && !isNaN(parseFloat(self.TablesData.Idf.B[self.TablesData.Drp]) && !isNaN(parseFloat(self.TablesData.StorageTable[key].T) && !isNaN(parseFloat(self.TablesData.Idf.D[self.TablesData.Drp])) && !isNaN(parseFloat(self.TablesData.Mi_r)) && !isNaN(parseFloat(self.TablesData.Toc))))){
                    self.TablesData.StorageTable[key].I = (parseFloat(self.TablesData.Idf.A[self.TablesData.Drp]) * (Math.pow((parseFloat(self.TablesData.Idf.B[self.TablesData.Drp]) + (parseFloat(self.TablesData.StorageTable[key].T) / parseInt(self.TablesData.timeUnit))), parseFloat(self.TablesData.Idf.D[self.TablesData.Drp]))).toFixed(1)).toFixed(1);
                    self.TablesData.StorageTable[key].Ix = ((parseFloat(self.TablesData.Idf.A[self.TablesData.Drp]) * (Math.pow((parseFloat(self.TablesData.StorageTable[key].T) / parseInt(self.TablesData.timeUnit)), parseFloat(self.TablesData.Idf.D[self.TablesData.Drp])))).toFixed(2) * parseFloat(self.TablesData.Mi_r)).toFixed(1);
                    self.TablesData.StorageTable[key].Pdq = ((parseFloat(self.TablesData.StorageTable[key].Ix) * parseFloat(self.TablesData.Pd_c) * parseFloat(self.TablesData.Area)) * (1 / 360)).toFixed(3);
                    self.TablesData.StorageTable[key].TraAv = (((parseFloat(self.TablesData.StorageTable[key].T) - parseFloat(self.TablesData.Toc)) + (parseFloat(self.TablesData.StorageTable[key].T) + parseFloat(self.TablesData.Toc))) * 0.5 * parseFloat(self.TablesData.StorageTable[key].Pdq) * parseInt(self.TablesData.timeUnit)).toFixed(1);
                    self.TablesData.StorageTable[key].TriAv = (0.5 * (parseFloat(self.TablesData.StorageTable[key].T) + parseFloat(self.TablesData.Toc)) * parseInt(self.TablesData.timeUnit) * parseFloat(self.TablesData.Maq)).toFixed(0);
                    if ((parseFloat(self.TablesData.StorageTable[key].TraAv) - parseFloat(self.TablesData.StorageTable[key].TriAv)) > 0)
                        self.TablesData.StorageTable[key].Sv = Math.floor(parseFloat(self.TablesData.StorageTable[key].TraAv) - parseFloat(self.TablesData.StorageTable[key].TriAv));
                    else
                        self.TablesData.StorageTable[key].Sv = 0;
                }
            });
            let max = 0;
            Object.keys(self.TablesData.StorageTable).forEach(key => {
                if (!isNaN(self.TablesData.StorageTable[key].Sv) && parseFloat(self.TablesData.StorageTable[key].Sv) > max)
                    max = self.TablesData.StorageTable[key].Sv;
                self.TablesData.MaxStorage = max;
            });
        });
    },
    methods:{
        filterNonNumeric(e) {
            e.target.value = e.target.value.replaceAll(/[^.\-0-9]/g, '');
        },
        addRow(e){
            this.TablesData[e.currentTarget.dataset.object].push({
                "land_use" : "",
                "area" : 0,
                "runoff_c": 0,
                "impervious": 0
            });
        },
        removeRow(e){
            this.TablesData[e.currentTarget.dataset.object].splice(this.TablesData[e.currentTarget.dataset.object].length - 1, 1);
        },
        EraseTable(e){
            this.TablesData[e.currentTarget.dataset.object].splice(0);
        },
        OpenFileBrowser(e){
            this.FileBrowserType = e.currentTarget.dataset.type;
            this.ExcelSeatTable = e.currentTarget.dataset.table;
            document.getElementById("FileBrowser").click();
        },
        UploadExcelFile(e){
            const self = this;
            const file = e.target.files[0];
            if (file.type !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
                alertify.error("No Excel file selected!");
            else{
                let data = new FormData();
                data.append("type",self.FileBrowserType);
                data.append("file",file);
                axios.post(route('Upload.Excel'),data).then((response) => {
                    e.target.value = '';
                    switch (response.data.result){
                        case "success":{
                            alertify.success("The Excel file data has been loaded successfully");
                            switch (self.ExcelSeatTable){
                                case "PreDevelopment":{
                                    self.TablesData.PreDevelopment = response.data.data;
                                    break;
                                }
                                case "PostDevelopment":{
                                    self.TablesData.PostDevelopment = response.data.data;
                                    break;
                                }
                                case "Idf":{
                                    self.TablesData.Idf.A = response.data.data.A;
                                    self.TablesData.Idf.B = response.data.data.B;
                                    self.TablesData.Idf.D = response.data.data.D;
                                    break;
                                }
                            }
                            break;
                        }
                        case "fails":{
                            alertify.error(response.data.message);
                            break;
                        }
                    }
                });
            }
        },
        DownloadExcel(type,kind = ''){
            const self = this;
            axios.post(route("Download.Excel"), {"data" : JSON.stringify(self.TablesData), "kind" : kind, "type" : type}, { responseType: 'blob' })
                .then(function (response) {
                    const url = window.URL.createObjectURL(new Blob([response.data],{ type: 'application/vnd.ms-excel' }));
                    self.download.name = `${kind}${type}Result.xlsx`;
                    self.download.file = url;
                    self.$nextTick().then(() => {
                        document.getElementById("DownloadResult").click();
                    });
                }).catch(function (error) {
            });
        },
        DownloadResult(e){
            const self = this;
            const section = e.currentTarget.dataset.section;
            switch (e.currentTarget.dataset.type){
                case "Pdf":{
                    axios.post(route("Download.Pdf"), {"section" : section, "data" : JSON.stringify(self.TablesData)}, { responseType: 'blob' })
                        .then(function (response) {
                            const url = window.URL.createObjectURL(new Blob([response.data],{ type: 'application/pdf' }));
                            self.download.name = `${section}Result.pdf`;
                            self.download.file = url;
                            self.$nextTick().then(() => {
                                document.getElementById("DownloadResult").click();
                            });
                        }).catch(function (error) {
                    });
                    break;
                }
                case "Csv":{
                    axios.post(route("Download.Csv"), {"section" : section, "data" : JSON.stringify(self.TablesData)}, { responseType: 'blob' })
                        .then(function (response) {
                            const url = window.URL.createObjectURL(new Blob([response.data],{ type: 'text/csv;charset=utf-8' }));
                            self.download.name = `${section}Result.csv`;
                            self.download.file = url;
                            self.$nextTick().then(() => {
                                document.getElementById("DownloadResult").click();
                            });
                        }).catch(function (error) {
                    });
                    break;
                }
            }
        },
        browseFiles(){
            document.querySelector('#localFile').click();
        },
        LoadLocalFile(e){
            const self = this;
            const file = e.target.files[0];
            self.loading = true;
            let reader = new FileReader();
            reader.readAsText(file, "UTF-8");
            reader.onload = function (evt) {
                self.TablesData = JSON.parse(evt.target.result.toString());
                self.loading = false;
                alertify.success(`${file.name} data has been loaded successfully`);
                document.getElementById("CloseLoadModal").click();
            }
            reader.onerror = function (evt) {
                alertify.error("Error reading file!");
                self.loading = false;
            }
        },
        SaveData(e){
            const self = this;
            self.loading = true;
            const type = e.currentTarget.dataset.type;
            switch (type){
                case "cloud":{
                    axios.post(route("Save"), {"filename" : self.filename, "data" : JSON.stringify(self.TablesData)})
                        .then(function (response) {
                            switch (response.data.result){
                                case "success":{
                                    document.getElementById("CloseSaveModal").click();
                                    alertify.success(`The data was successfully saved to the ${response.data.filename}`);
                                    self.loading = false;
                                    break;
                                }
                                case "fails":{
                                    alertify.error(response.data.error);
                                    self.loading = false;
                                    break;
                                }
                            }
                        }).catch(function (error) {
                        alertify.error(error);
                    });
                    break;
                }
                case "personal":{
                    const filename = `${self.filename}_${new Date().getTime()}.json`;
                    const link = document.createElement("a");
                    link.href = window.URL.createObjectURL(new Blob([JSON.stringify(self.TablesData)],{ type: 'text/json;charset=utf-8' }));
                    link.download = filename;
                    link.click();
                    URL.revokeObjectURL(link.href);
                    link.remove();
                    alertify.success(`The data was successfully saved to the ${filename}`);
                    self.loading = false;
                    break;
                }
            }
        },
        GetFiles(){
            const self = this;
            axios.post(route("GetFiles"))
                .then(function (response) {
                    switch (response.data.result){
                        case "success":{
                            self.SavedFiles = response.data.data;
                            break;
                        }
                        case "fails":{
                            alertify.error(response.data.error);
                            break;
                        }
                    }
                }).catch(function (error) {
                alertify.error(error);
            });
        },
        OpenDirectory(e){
            const self = this;
            const selected_directory = e.currentTarget.dataset.directory;
            const files = self.SavedFiles.find(item => {return item.directory === selected_directory});
            if(files.files){
                files.files.forEach(file => {
                    self.AllFiles.push({"directory" : selected_directory, "file" : file});
                });
                self.FileViewType = "file";
            }

        },
        LoadData(e){
            const self = this;
            self.loading = true;
            const file = self.AllFiles[e.currentTarget.dataset.file_index];
            if (file){
                axios.post(route("Load"),{"directory":file.directory,"file":file.file})
                    .then(function (response) {
                        switch (response.data.result){
                            case "success":{
                                self.TablesData = response.data.data;
                                self.$forceUpdate();
                                document.getElementById("CloseLoadModal").click();
                                alertify.success(`${file.file} data has been loaded successfully`);
                                self.loading = false;
                                break;
                            }
                            case "fails":{
                                alertify.error(response.data.error);
                                self.loading = false;
                                break;
                            }
                        }
                    }).catch(function (error) {
                    alertify.error(error);
                });
            }
        }
    }
}).use(ZiggyVue, Ziggy);
app.mount("#app");
