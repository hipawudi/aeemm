import{_ as q}from"./AdminLayout.c72fa573.js";import{q as A}from"./index.3c5e6273.js";import{_ as D}from"./_plugin-vue_export-helper.cdc0426e.js";import{U as F}from"./UploadOutlined.f2b01814.js";import{R as B}from"./RestFilled.a80d11a9.js";import{C as b,D as n,o as i,c as h,w as s,a as _,b as l,f as c,d as f,t as x,F as w,e as y}from"./app.7f364e3c.js";import"./UserOutlined.1f8715dd.js";import"./AppstoreOutlined.bae1f559.js";const M={components:{AdminLayout:q,UploadOutlined:F,RestFilled:B,quillEditor:A},props:["messageCategories","messages","members"],data(){return{modal:{isOpen:!1,data:{},title:"Modal",mode:""},pagination:{total:this.messages.total,current:this.messages.current_page,pageSize:this.messages.per_page},filter:{},columns:[{title:"\u5206\u985E",dataIndex:"category",width:80},{title:"\u6A19\u984C",dataIndex:"title"},{title:"\u767C\u4EF6\u4EBA",dataIndex:"sender",width:120},{title:"\u6536\u4EF6\u4EBA",dataIndex:"receiver",width:120},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation",width:200}],rules:{field:{required:!0},label:{required:!0}},validateMessages:{required:"\u8ACB\u8F93\u5165${label}",types:{email:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u90F5\u7BB1\u683C\u5F0F",number:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u6578\u5B57\u683C\u5F0F"},number:{range:"${label} \u5FC5\u9808\u5728${min}\u548C${max}\u4E4B\u9593"}},labelCol:{style:{width:"150px"}}}},created(){},methods:{createRecord(a){this.modal.data={},this.modal.mode="CREATE",this.modal.isOpen=!0},editRecord(a){this.modal.data={...a},this.modal.mode="EDIT",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.messages.store"),this.modal.data,{preserveState:!1,onSuccess:a=>{this.modal.isOpen=!1,b.success("\u65B0\u589E\u6210\u529F")},onError:a=>{console.log(a)}})}).catch(a=>{console.log(a)})},updateRecord(){this.$refs.modalRef.validateFields().then(()=>{this.modal.data._method="PATCH",this.$inertia.post(route("admin.messages.update",this.modal.data.id),this.modal.data,{preserveState:!1,onSuccess:a=>{this.modal.isOpen=!1,b.success("\u4FEE\u6539\u6210\u529F")},onError:a=>{console.log(a)}})}).catch(a=>{console.log("error",a)})},deleteRecord(a){this.$inertia.delete("/admin/messages/"+a,{preserveState:!1,onSuccess:e=>{b.success("\u522A\u9664\u6210\u529F"),console.log(e)},onError:e=>{alert(e.message)}})},onPaginationChange(a,e,r){this.$inertia.get(route("admin.messages.index"),{page:a.current,per_page:a.pageSize},{onSuccess:v=>{console.log(v)},onError:v=>{console.log(v)}})}}},N={class:"p-8 pt-8"},V={class:"flex pb-2"},L=_("div",{class:"flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"}," \u901A\u4FE1\u7BA1\u7406 ",-1),P={class:"flex-auto w-1/2 text-right"},z={class:"card drop-shadow-md pt-4"},H={key:0,class:"space-x-2"},j={key:0},G={key:1};function J(a,e,r,v,t,m){const u=n("a-button"),S=n("a-popconfirm"),E=n("a-table"),C=n("a-select"),p=n("a-form-item"),k=n("a-input"),I=n("quill-editor"),U=n("a-form"),O=n("a-modal"),T=n("AdminLayout");return i(),h(T,{title:"Dashboard"},{default:s(()=>[_("div",N,[_("div",V,[L,_("div",P,[l(u,{type:"primary",class:"!rounded",onClick:e[0]||(e[0]=o=>m.createRecord())},{default:s(()=>[c("\u65B0\u589E\u901A\u4FE1")]),_:1})])]),_("div",z,[l(E,{dataSource:r.messages.data,columns:t.columns,pagination:t.pagination,onChange:m.onPaginationChange,ref:"dataTable"},{bodyCell:s(({column:o,text:K,record:d,index:Q})=>{var R;return[o.dataIndex=="operation"?(i(),f("div",H,[l(u,{onClick:g=>m.editRecord(d)},{default:s(()=>[c("\u4FEE\u6539")]),_:2},1032,["onClick"]),l(S,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u901A\u4FE1","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:g=>m.deleteRecord(d.id)},{default:s(()=>[l(u,null,{default:s(()=>[c("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"])])):o.dataIndex=="category"?(i(),f(w,{key:1},[c(x(r.messageCategories.find(g=>g.value==d.category).label),1)],64)):o.dataIndex=="receiver"?(i(),f(w,{key:2},[d.category=="personal"||d.category=="public"?(i(),f("div",j,x(r.messageCategories.find(g=>g.value==d.category).label),1)):(i(),f("div",G,x((R=d.receiver)!=null?R:"--"),1))],64)):y("",!0)]}),_:1},8,["dataSource","columns","pagination","onChange"])]),l(O,{visible:t.modal.isOpen,"onUpdate:visible":e[8]||(e[8]=o=>t.modal.isOpen=o),title:t.modal.title,width:"60%"},{footer:s(()=>[t.modal.mode=="EDIT"?(i(),h(u,{key:"Update",type:"primary",onClick:e[6]||(e[6]=o=>m.updateRecord())},{default:s(()=>[c("Update")]),_:1})):y("",!0),t.modal.mode=="CREATE"?(i(),h(u,{key:"Store",type:"primary",onClick:e[7]||(e[7]=o=>m.storeRecord())},{default:s(()=>[c("Add")]),_:1})):y("",!0)]),default:s(()=>[l(U,{ref:"modalRef",model:t.modal.data,name:"Teacher","label-col":{span:4},"wrapper-col":{span:20},autocomplete:"off",rules:t.rules,"validate-messages":t.validateMessages},{default:s(()=>[l(p,{label:"\u5206\u985E",name:"category"},{default:s(()=>[l(C,{value:t.modal.data.category,"onUpdate:value":e[1]||(e[1]=o=>t.modal.data.category=o),options:r.messageCategories},null,8,["value","options"])]),_:1}),t.modal.data.category=="personal"?(i(),h(p,{key:0,label:"\u6536\u4EF6\u4EBA",name:"receiver"},{default:s(()=>[l(C,{value:t.modal.data.receiver,"onUpdate:value":e[2]||(e[2]=o=>t.modal.data.receiver=o),options:r.members,"field-names":{label:"display_name",value:"id"}},null,8,["value","options"])]),_:1})):y("",!0),l(p,{label:"\u767C\u4EF6\u4EBA",name:"sender"},{default:s(()=>[l(k,{value:t.modal.data.sender,"onUpdate:value":e[3]||(e[3]=o=>t.modal.data.sender=o)},null,8,["value"])]),_:1}),l(p,{label:"\u6A19\u984C",name:"title"},{default:s(()=>[l(k,{value:t.modal.data.title,"onUpdate:value":e[4]||(e[4]=o=>t.modal.data.title=o)},null,8,["value"])]),_:1}),l(p,{label:"\u5167\u5BB9",name:"content"},{default:s(()=>[l(I,{value:t.modal.data.content,"onUpdate:value":e[5]||(e[5]=o=>t.modal.data.content=o),style:{"min-height":"200px"}},null,8,["value"])]),_:1})]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const oe=D(M,[["render",J]]);export{oe as default};
