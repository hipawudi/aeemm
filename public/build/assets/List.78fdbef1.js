import{_ as U}from"./AdminLayout.90f2d3cf.js";import{_ as E}from"./_plugin-vue_export-helper.cdc0426e.js";import{C as s,D as d,o as _,c as h,w as o,a as r,b as l,f as m,d as y,t as I,F as z,e as f}from"./app.5bc04564.js";import"./UserOutlined.9b50d372.js";import"./AppstoreOutlined.68a63fa9.js";const O={components:{AdminLayout:U},props:["members","gender","membership_levels"],data(){return{columns:[{title:"\u59D3\u540D(\u4E2D\u6587)",dataIndex:"name_zh"},{title:"\u59D3\u540D(\u82F1\u6587)",dataIndex:"name_en"},{title:"\u96FB\u5B50\u90F5\u7BB1",dataIndex:"email"},{title:"\u624B\u6A5F",dataIndex:"phone"},{title:"\u72C0\u614B",dataIndex:"state"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation",width:300}],employmentStates:[{label:"\u6D3B\u8E8D",value:1},{label:"\u975E\u6D3B\u8E8D",value:2},{label:"\u9000\u6703",value:3}],modal:{isOpen:!1,data:{},title:"Modal",mode:""},pagination:{showSizeChanger:this.members.total>10?ture:!1,total:this.members.total,current:this.members.current_page,pageSize:this.members.per_page},filter:{},rules:{name_zh:{required:!0},name_en:{required:!0},gender:{required:!0},birth:{required:!0},address:{required:!0},name_en:{required:!0},phone:{required:!0},company:{required:!0},position:{required:!0},membership_level:{required:!0},email:{required:!0,type:"email"}},validateMessages:{required:"\u8ACB\u8F93\u5165${label}",types:{email:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u90F5\u7BB1\u683C\u5F0F",number:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u6578\u5B57\u683C\u5F0F"},number:{range:"${label} \u5FC5\u9808\u5728${min}\u548C${max}\u4E4B\u9593"}},labelCol:{style:{width:"150px"}}}},created(){},methods:{createRecord(){this.modal.data={state:1},this.modal.mode="CREATE",this.modal.title="\u65B0\u589E\u6703\u54E1",this.modal.isOpen=!0},editRecord(n){console.log(n),this.modal.data={...n},this.modal.mode="EDIT",this.modal.title="\u4FEE\u6539",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.members.store"),this.modal.data,{onSuccess:n=>{this.modal.data={},this.modal.isOpen=!1,s.success("\u65B0\u589E\u6210\u529F")},onError:n=>{console.log(n),s.success("\u65B0\u589E\u5931\u6557")}})}).catch(n=>{console.log(n),s.success("\u65B0\u589E\u5931\u6557")})},updateRecord(){console.log(this.modal.data),this.$refs.modalRef.validateFields().then(()=>{this.$inertia.patch("/admin/members/"+this.modal.data.id,this.modal.data,{onSuccess:n=>{this.modal.data={},this.modal.isOpen=!1,s.success("\u4FEE\u6539\u6210\u529F")},onError:n=>{s.warning("\u4FEE\u6539\u5931\u6557")}})}).catch(n=>{console.log("error",n),s.success("\u65B0\u589E\u5931\u6557")})},deleteRecord(n){this.$inertia.delete("/admin/members/"+n,{onSuccess:e=>{console.log(e),s.success("\u522A\u9664\u6210\u529F")},onError:e=>{console.log(e),s.success("\u522A\u9664\u5931\u6557")}})},createLogin(n){n.email==null?s.warning("\u6B64\u6703\u54E1\u6C92\u6709\u96FB\u90F5\u4E0D\u80FD\u5EFA\u7ACB\u5E33\u865F"):this.$inertia.post(route("admin.members.createLogin"),{id:n.id},{onSuccess:e=>{s.success("\u767C\u9001\u9A57\u8B49\u90F5\u4EF6\u6210\u529F")},onError:e=>{console.log(e),s.success("\u767C\u9001\u9A57\u8B49\u90F5\u4EF6\u5931\u6557")}})},onPaginationChange(n,e,b){this.$inertia.get(route("admin.members.index"),{page:n.current,per_page:n.pageSize})}}},L={class:"p-8 pt-8"},T={class:"flex pb-2"},D=r("div",{class:"basis-1/2 font-semibold text-xl text-gray-800"},"\u6703\u54E1\u5217\u8868",-1),A={class:"basis-1/2 text-right"},F={class:"card drop-shadow-md pt-4"},M={key:1,class:"space-x-2"},B={class:"flex flex-col"},N={class:"flex justify-between gap-3"},V={class:"flex-auto w-3/4"},Y={class:"flex-auto w-1/4"};function P(n,e,b,j,a,u){const p=d("a-button"),C=d("a-popconfirm"),k=d("a-table"),c=d("a-input"),i=d("a-form-item"),x=d("a-select"),R=d("a-date-picker"),S=d("a-form"),q=d("a-modal"),w=d("AdminLayout");return _(),h(w,{title:"\u6703\u54E1\u5217\u8868"},{default:o(()=>[r("div",L,[r("div",T,[D,r("div",A,[l(p,{onClick:e[0]||(e[0]=t=>u.createRecord()),type:"primary",class:"!rounded"},{default:o(()=>[m("\u65B0\u589E\u6703\u54E1")]),_:1})])]),r("div",F,[l(k,{dataSource:b.members.data,"text-right":"",columns:a.columns,pagination:a.pagination,onChange:u.onPaginationChange,ref:"dataTable"},{bodyCell:o(({column:t,record:v})=>[t.dataIndex=="state"?(_(),y(z,{key:0},[m(I(a.employmentStates.find(g=>g.value==v.state).label),1)],64)):f("",!0),t.dataIndex=="operation"?(_(),y("div",M,[l(p,{onClick:g=>u.editRecord(v)},{default:o(()=>[m("\u4FEE\u6539")]),_:2},1032,["onClick"]),l(C,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u6210\u54E1","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:g=>u.deleteRecord(v.id)},{default:o(()=>[l(p,null,{default:o(()=>[m("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"]),v.user?f("",!0):(_(),h(p,{key:0,onClick:g=>u.createLogin(v)},{default:o(()=>[m("\u5EFA\u7ACB\u5E33\u865F")]),_:2},1032,["onClick"]))])):f("",!0)]),_:1},8,["dataSource","columns","pagination","onChange"])]),l(q,{visible:a.modal.isOpen,"onUpdate:visible":e[14]||(e[14]=t=>a.modal.isOpen=t),title:a.modal.title,width:"60%"},{footer:o(()=>[l(p,{key:"back",onClick:e[11]||(e[11]=t=>a.modal.isOpen=!1)},{default:o(()=>[m("\u53D6\u6D88")]),_:1}),a.modal.mode=="EDIT"?(_(),h(p,{key:"Update",type:"primary",onClick:e[12]||(e[12]=t=>u.updateRecord())},{default:o(()=>[m("\u78BA\u5B9A")]),_:1})):f("",!0),a.modal.mode=="CREATE"?(_(),h(p,{key:"Store",type:"primary",onClick:e[13]||(e[13]=t=>u.storeRecord())},{default:o(()=>[m("\u65B0\u589E")]),_:1})):f("",!0)]),default:o(()=>[l(S,{ref:"modalRef",model:a.modal.data,name:"Teacher",autocomplete:"off",layout:"horizontal",rules:a.rules,"label-col":a.labelCol,"validate-messages":a.validateMessages},{default:o(()=>[r("div",B,[r("div",N,[r("div",V,[l(i,{label:"\u4E2D\u6587\u59D3\u540D",name:"name_zh"},{default:o(()=>[l(c,{value:a.modal.data.name_zh,"onUpdate:value":e[1]||(e[1]=t=>a.modal.data.name_zh=t)},null,8,["value"])]),_:1})]),r("div",Y,[l(i,{label:"\u6027\u5225",name:"gender"},{default:o(()=>[l(x,{options:b.gender,value:a.modal.data.gender,"onUpdate:value":e[2]||(e[2]=t=>a.modal.data.gender=t)},null,8,["options","value"])]),_:1})])]),l(i,{label:"\u82F1\u6587\u59D3\u540D",name:"name_en"},{default:o(()=>[l(c,{value:a.modal.data.name_en,"onUpdate:value":e[3]||(e[3]=t=>a.modal.data.name_en=t)},null,8,["value"])]),_:1}),l(i,{label:"\u51FA\u751F\u65E5\u671F",name:"birth"},{default:o(()=>[l(R,{value:a.modal.data.birth,"onUpdate:value":e[4]||(e[4]=t=>a.modal.data.birth=t),valueFormat:"YYYY-MM-DD"},null,8,["value"])]),_:1}),l(i,{label:"\u901A\u8FC5\u5730\u5740",name:"address"},{default:o(()=>[l(c,{value:a.modal.data.address,"onUpdate:value":e[5]||(e[5]=t=>a.modal.data.address=t)},null,8,["value"])]),_:1}),l(i,{label:"\u806F\u7D61\u96FB\u8A71",name:"phone"},{default:o(()=>[l(c,{value:a.modal.data.phone,"onUpdate:value":e[6]||(e[6]=t=>a.modal.data.phone=t)},null,8,["value"])]),_:1}),l(i,{label:"\u96FB\u5B50\u90F5\u7BB1",name:"email"},{default:o(()=>[l(c,{value:a.modal.data.email,"onUpdate:value":e[7]||(e[7]=t=>a.modal.data.email=t)},null,8,["value"])]),_:1}),l(i,{label:"\u5DE5\u4F5C\u6A5F\u69CB",name:"company"},{default:o(()=>[l(c,{value:a.modal.data.company,"onUpdate:value":e[8]||(e[8]=t=>a.modal.data.company=t)},null,8,["value"])]),_:1}),l(i,{label:"\u8077\u4F4D",name:"position"},{default:o(()=>[l(c,{value:a.modal.data.position,"onUpdate:value":e[9]||(e[9]=t=>a.modal.data.position=t)},null,8,["value"])]),_:1}),l(i,{label:"\u7533\u8ACB\u6703\u7C4D",name:"membership_level"},{default:o(()=>[l(x,{options:b.membership_levels,value:a.modal.data.membership_level,"onUpdate:value":e[10]||(e[10]=t=>a.modal.data.membership_level=t)},null,8,["options","value"])]),_:1})])]),_:1},8,["model","rules","label-col","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const W=E(O,[["render",P]]);export{W as default};
