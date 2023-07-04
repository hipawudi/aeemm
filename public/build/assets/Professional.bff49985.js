import{_ as T}from"./AdminLayout.c72fa573.js";import{_ as w}from"./_plugin-vue_export-helper.cdc0426e.js";import{U as A}from"./UploadOutlined.f2b01814.js";import{D as i,o as m,c as y,w as l,a as n,b as o,f as r,d as v,t as b,F as h,e as F}from"./app.7f364e3c.js";import"./UserOutlined.1f8715dd.js";import"./AppstoreOutlined.bae1f559.js";const D={components:{AdminLayout:T,UploadOutlined:A},props:["professionals","certificates","members"],data(){return{dateFormat:"YYYY-MM-DD",modal:{isOpen:!1,data:{},title:"Modal",mode:""},columns:[{title:"\u5C08\u696D\u8A8D\u8B49",dataIndex:"cert_title",model:"certificate"},{title:"\u6210\u54E1\u540D\u7A31",dataIndex:"display_name",model:"member"},{title:"\u8A8D\u8B49\u540D\u7247\u865F\u78BC",dataIndex:"number_display"},{title:"\u7C3D\u767C\u65E5\u671F",dataIndex:"issue_date"},{title:"\u6709\u6548\u671F\u81EA",dataIndex:"valid_from"},{title:"\u6709\u6548\u671F\u81F3",dataIndex:"valid_until"},{title:"\u6388\u6B0A\u4EBA",dataIndex:"authorize_by"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation"}],rules:{certificate_id:{required:!0},member_id:{required:!0},issue_date:{required:!0},authorize_by:{required:!0}},validateMessages:{required:"${label} is required!",types:{email:"${label} is not a valid email!",number:"${label} is not a valid number!"},number:{range:"${label} must be between ${min} and ${max}"}},labelCol:{style:{width:"150px"}}}},created(){},methods:{createRecord(d){this.modal.data={},this.modal.data.media=[],this.modal.data.certificate={},this.modal.data.member={},this.modal.mode="CREATE",this.modal.isOpen=!0},editRecord(d){this.modal.data={...d},this.modal.mode="EDIT",this.modal.title="\u4FEE\u6539",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.professionals.store"),this.modal.data,{preserveState:!1,onSuccess:d=>{this.modal.isOpen=!1},onError:d=>{console.log(d)}})}).catch(d=>{console.log(d)})},updateRecord(){this.$refs.modalRef.validateFields().then(()=>{this.modal.data._method="PATCH",this.$inertia.post(route("admin.professionals.update",this.modal.data.id),this.modal.data,{preserveState:!1,onSuccess:d=>{this.modal.isOpen=!1},onError:d=>{console.log(d)}})}).catch(d=>{console.log("error",d)})},deleteRecord(d){this.$inertia.delete("/admin/professionals/"+d,{preserveState:!1,onSuccess:a=>{console.log(a)},onError:a=>{console.log(a)}})}}},q={class:"p-8 pt-8"},z={class:"flex pb-2"},M=n("div",{class:"basis-1/2 font-semibold text-xl text-gray-800"},"\u5C08\u696D\u8B49\u66F8",-1),B={class:"basis-1/2 text-right"},N={class:"card drop-shadow-md pt-4"},V={key:0,class:"space-x-2"},Y={class:"flex gap-2 items-center"},L={class:"flex-initial"},P={class:"flex-auto"};function H(d,a,f,j,e,u){const _=i("a-button"),C=i("a-popconfirm"),R=i("a-table"),k=i("a-select"),s=i("a-form-item"),g=i("a-input"),x=i("a-date-picker"),I=i("a-textarea"),E=i("a-form"),U=i("a-modal"),S=i("AdminLayout");return m(),y(S,{title:"Dashboard"},{default:l(()=>[n("div",q,[n("div",z,[M,n("div",B,[o(_,{onClick:a[0]||(a[0]=t=>u.createRecord()),type:"primary",class:"!rounded"},{default:l(()=>[r("\u65B0\u589E\u5C08\u696D\u8B49\u66F8")]),_:1})])]),n("div",N,[o(R,{dataSource:f.professionals,columns:e.columns},{bodyCell:l(({column:t,text:c,record:p,index:G})=>[t.dataIndex=="operation"?(m(),v("div",V,[o(_,{onClick:O=>u.editRecord(p)},{default:l(()=>[r("\u4FEE\u6539")]),_:2},1032,["onClick"]),o(C,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u5C08\u696D\u8B49\u66F8","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:O=>u.deleteRecord(p.id)},{default:l(()=>[o(_,null,{default:l(()=>[r("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"])])):t.model=="member"?(m(),v(h,{key:1},[r(b(p.member[t.dataIndex]),1)],64)):t.model=="certificate"?(m(),v(h,{key:2},[r(b(p.certificate[t.dataIndex]),1)],64)):(m(),v(h,{key:3},[r(b(p[t.dataIndex]),1)],64))]),_:1},8,["dataSource","columns"])]),o(U,{visible:e.modal.isOpen,"onUpdate:visible":a[11]||(a[11]=t=>e.modal.isOpen=t),title:e.modal.mode=="CREATE"?"\u65B0\u589E":"\u4FEE\u6539",width:"60%"},{footer:l(()=>[e.modal.mode=="EDIT"?(m(),y(_,{key:"Update",type:"primary",onClick:a[9]||(a[9]=t=>u.updateRecord())},{default:l(()=>[r("\u66F4\u65B0")]),_:1})):F("",!0),e.modal.mode=="CREATE"?(m(),y(_,{key:"Store",type:"primary",onClick:a[10]||(a[10]=t=>u.storeRecord())},{default:l(()=>[r("\u65B0\u589E")]),_:1})):F("",!0)]),default:l(()=>[o(E,{ref:"modalRef",model:e.modal.data,name:"Teacher","label-col":{span:4},"wrapper-col":{span:24},autocomplete:"off",rules:e.rules,"validate-messages":e.validateMessages},{default:l(()=>[o(s,{label:"\u5C08\u696D\u8A8D\u8B49",name:"certificate_id"},{default:l(()=>[o(k,{value:e.modal.data.certificate_id,"onUpdate:value":a[1]||(a[1]=t=>e.modal.data.certificate_id=t),options:f.certificates,"field-names":{label:"cert_title",value:"id"}},null,8,["value","options"])]),_:1}),o(s,{label:"\u6210\u54E1\u540D\u7A31",name:"member_id"},{default:l(()=>[o(k,{value:e.modal.data.member_id,"onUpdate:value":a[2]||(a[2]=t=>e.modal.data.member_id=t),options:f.members,"field-names":{label:"display_name",value:"id"}},null,8,["value","options"])]),_:1}),o(s,{label:"\u8B49\u66F8\u865F\u78BC",name:"number_display"},{default:l(()=>{var t;return[n("div",Y,[n("div",L,b((t=f.certificates.find(c=>c.id==e.modal.data.certificate_id))==null?void 0:t.number_format),1),n("div",P,[o(g,{value:e.modal.data.number_display,"onUpdate:value":a[3]||(a[3]=c=>e.modal.data.number_display=c)},null,8,["value"])])])]}),_:1}),o(s,{label:"\u7C3D\u767C\u65E5\u671F",name:"issue_date"},{default:l(()=>[o(x,{value:e.modal.data.issue_date,"onUpdate:value":a[4]||(a[4]=t=>e.modal.data.issue_date=t),format:e.dateFormat,valueFormat:e.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),o(s,{label:"\u6709\u6548\u671F\u81EA",name:"valid_from"},{default:l(()=>[o(x,{value:e.modal.data.valid_from,"onUpdate:value":a[5]||(a[5]=t=>e.modal.data.valid_from=t),format:e.dateFormat,valueFormat:e.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),o(s,{label:"\u6709\u6548\u671F\u81F3",name:"valid_until"},{default:l(()=>[o(x,{value:e.modal.data.valid_until,"onUpdate:value":a[6]||(a[6]=t=>e.modal.data.valid_until=t),format:e.dateFormat,valueFormat:e.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),o(s,{label:"\u6388\u6B0A\u4EBA",name:"authorize_by"},{default:l(()=>[o(g,{value:e.modal.data.authorize_by,"onUpdate:value":a[7]||(a[7]=t=>e.modal.data.authorize_by=t)},null,8,["value"])]),_:1}),o(s,{label:"\u5099\u8A3B",name:"remark"},{default:l(()=>[o(I,{value:e.modal.data.remark,"onUpdate:value":a[8]||(a[8]=t=>e.modal.data.remark=t)},null,8,["value"])]),_:1})]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const $=w(D,[["render",H]]);export{$ as default};