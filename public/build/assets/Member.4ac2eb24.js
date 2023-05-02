import{_ as I}from"./AdminLayout.3c6c2582.js";import{_ as w}from"./_plugin-vue_export-helper.cdc0426e.js";import{N as b,C as s,o as u,c as g,w as n,a as f,b as l,f as i,d as x,t as U,F as O,e as _}from"./app.c3d7625a.js";import"./UserOutlined.d2870da5.js";import"./AppstoreOutlined.5d8f3430.js";const T={components:{AdminLayout:I},props:["members"],data(){return{columns:[{title:"\u59D3\u540D(\u4E2D\u6587)",dataIndex:"name_zh"},{title:"\u59D3\u540D(\u5916\u6587)",dataIndex:"name_en"},{title:"\u5225\u540D",dataIndex:"gender"},{title:"\u624B\u6A5F",dataIndex:"dob"},{title:"\u72C0\u614B",dataIndex:"state"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation",width:300}],employmentStates:[{label:"\u5B58\u5728",value:1},{label:"\u53D6\u6D88",value:2}],modal:{isOpen:!1,data:{},title:"Modal",mode:""},pagination:{total:this.members.total,current:this.members.current_page,pageSize:this.members.per_page},filter:{},rules:{name_zh:{required:!0},mobile:{required:!0},state:{required:!0},email:{type:"email"}},validateMessages:{required:"\u8ACB\u8F93\u5165${label}",types:{email:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u90F5\u7BB1\u683C\u5F0F",number:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u6578\u5B57\u683C\u5F0F"},number:{range:"${label} \u5FC5\u9808\u5728${min}\u548C${max}\u4E4B\u9593"}},labelCol:{style:{width:"150px"}}}},created(){},methods:{createRecord(){this.modal.data={state:1},this.modal.mode="CREATE",this.modal.title="\u65B0\u589E\u6703\u54E1",this.modal.isOpen=!0},editRecord(a){console.log(a),this.modal.data={...a},this.modal.mode="EDIT",this.modal.title="\u4FEE\u6539",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.members.store"),this.modal.data,{onSuccess:a=>{this.modal.data={},this.modal.isOpen=!1},onError:a=>{console.log(a)}})}).catch(a=>{console.log(a)})},updateRecord(){console.log(this.modal.data),this.$refs.modalRef.validateFields().then(()=>{this.$inertia.patch("/admin/members/"+this.modal.data.id,this.modal.data,{onSuccess:a=>{this.modal.data={},this.modal.isOpen=!1,b.success("\u4FEE\u6539\u6210\u529F")},onError:a=>{b.warning("\u4FEE\u6539\u5931\u6557")}})}).catch(a=>{console.log("error",a)})},deleteRecord(a){this.$inertia.delete("/admin/members/"+a,{onSuccess:e=>{console.log(e)},onError:e=>{console.log(e)}})},createLogin(a){a.email==null?b.warning("\u6B64\u6703\u54E1\u6C92\u6709\u96FB\u90F5\u4E0D\u80FD\u5EFA\u7ACB\u5E33\u865F"):this.$inertia.post(route("admin.members.createLogin"),{id:a.id},{onSuccess:e=>{b.success("\u767C\u9001\u9A57\u8B49\u90F5\u4EF6\u6210\u529F")},onError:e=>{console.log(e)}})},onPaginationChange(a,e,v){console.log(a.current),this.$inertia.get(route("admin.members.index"),{page:a.current,per_page:10})}}},z={class:"p-8 pt-8"},A={class:"flex pb-2"},L=f("div",{class:"basis-1/2 font-semibold text-xl text-gray-800"},"\u6703\u54E1\u5217\u8868",-1),N={class:"basis-1/2 text-right"},q={class:"card drop-shadow-md pt-4"},B={key:1,class:"space-x-2"};function D(a,e,v,F,t,d){const m=s("a-button"),y=s("a-popconfirm"),C=s("a-table"),p=s("a-input"),r=s("a-form-item"),k=s("a-select"),R=s("a-form"),E=s("a-modal"),S=s("AdminLayout");return u(),g(S,{title:"Dashboard"},{default:n(()=>[f("div",z,[f("div",A,[L,f("div",N,[l(m,{onClick:e[0]||(e[0]=o=>d.createRecord()),type:"primary",class:"!rounded"},{default:n(()=>[i("\u65B0\u589E\u6703\u54E1")]),_:1})])]),f("div",q,[l(C,{dataSource:v.members.data,"text-right":"",columns:t.columns,pagination:t.pagination,onChange:d.onPaginationChange,ref:"dataTable"},{bodyCell:n(({column:o,text:M,record:c,index:V})=>[o.dataIndex=="state"?(u(),x(O,{key:0},[i(U(c.state==1?"\u5B58\u5728":"\u53D6\u6D88"),1)],64)):_("",!0),o.dataIndex=="operation"?(u(),x("div",B,[l(m,{onClick:h=>d.editRecord(c)},{default:n(()=>[i("\u4FEE\u6539")]),_:2},1032,["onClick"]),l(y,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u6210\u54E1","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:h=>d.deleteRecord(c.id)},{default:n(()=>[l(m,null,{default:n(()=>[i("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"]),c.user?_("",!0):(u(),g(m,{key:0,onClick:h=>d.createLogin(c)},{default:n(()=>[i("\u5EFA\u7ACB\u5E33\u865F")]),_:2},1032,["onClick"]))])):_("",!0)]),_:1},8,["dataSource","columns","pagination","onChange"])]),l(E,{visible:t.modal.isOpen,"onUpdate:visible":e[10]||(e[10]=o=>t.modal.isOpen=o),title:t.modal.title,width:"60%"},{footer:n(()=>[l(m,{key:"back",onClick:e[7]||(e[7]=o=>t.modal.isOpen=!1)},{default:n(()=>[i("\u53D6\u6D88")]),_:1}),t.modal.mode=="EDIT"?(u(),g(m,{key:"Update",type:"primary",onClick:e[8]||(e[8]=o=>d.updateRecord())},{default:n(()=>[i("Update")]),_:1})):_("",!0),t.modal.mode=="CREATE"?(u(),g(m,{key:"Store",type:"primary",onClick:e[9]||(e[9]=o=>d.storeRecord())},{default:n(()=>[i("Add")]),_:1})):_("",!0)]),default:n(()=>[l(R,{ref:"modalRef",model:t.modal.data,name:"Teacher","label-col":{span:8},"wrapper-col":{span:16},autocomplete:"off",rules:t.rules,"validate-messages":t.validateMessages},{default:n(()=>[l(r,{label:"\u59D3\u540D(\u4E2D\u6587)",name:"name_zh"},{default:n(()=>[l(p,{value:t.modal.data.name_zh,"onUpdate:value":e[1]||(e[1]=o=>t.modal.data.name_zh=o)},null,8,["value"])]),_:1}),l(r,{label:"\u59D3\u540D(\u5916\u6587)",name:"name_en"},{default:n(()=>[l(p,{value:t.modal.data.name_en,"onUpdate:value":e[2]||(e[2]=o=>t.modal.data.name_en=o)},null,8,["value"])]),_:1}),l(r,{label:"\u986F\u793A\u540D\u7A31",name:"display_name"},{default:n(()=>[l(p,{value:t.modal.data.display_name,"onUpdate:value":e[3]||(e[3]=o=>t.modal.data.display_name=o)},null,8,["value"])]),_:1}),l(r,{label:"\u96FB\u5B50\u90F5\u4EF6",name:"email"},{default:n(()=>[l(p,{value:t.modal.data.email,"onUpdate:value":e[4]||(e[4]=o=>t.modal.data.email=o)},null,8,["value"])]),_:1}),l(r,{label:"\u624B\u6A5F",name:"phone"},{default:n(()=>[l(p,{value:t.modal.data.phone,"onUpdate:value":e[5]||(e[5]=o=>t.modal.data.phone=o)},null,8,["value"])]),_:1}),l(r,{label:"\u72C0\u614B",name:"state"},{default:n(()=>[l(k,{value:t.modal.data.state,"onUpdate:value":e[6]||(e[6]=o=>t.modal.data.state=o),options:t.employmentStates},null,8,["value","options"])]),_:1})]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const K=w(T,[["render",D]]);export{K as default};
