import{_ as g}from"./WebLayout.63585022.js";import{N as y,C as m,D as i,o as p,c as q,w as o,a as s,d as v,b as t,f as U}from"./app.5bc04564.js";import{_ as k}from"./_plugin-vue_export-helper.cdc0426e.js";import"./ResponsiveNavLink.98130056.js";import"./VerifiedOutlined.925faa1b.js";import"./AppstoreOutlined.68a63fa9.js";const w={components:{WebLayout:g,dayjs:y},props:["member_application","gender","membership_levels"],setup(){},data(){return{data:{},labelCol:{style:{width:"100px"}},rules:{name_zh:{required:!0},name_en:{required:!0},gender:{required:!0},birth:{required:!0},address:{required:!0},name_en:{required:!0},phone:{required:!0},company:{required:!0},position:{required:!0},membership_level:{required:!0},email:{required:!0,type:"email"}},validateMessages:{required:"\u8ACB\u8F93\u5165${label}",types:{email:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u90F5\u7BB1\u683C\u5F0F",number:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u6578\u5B57\u683C\u5F0F"},number:{range:"${label} \u5FC5\u9808\u5728${min}\u548C${max}\u4E4B\u9593"}}}},methods:{storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("member.application.store"),this.data,{onSuccess:d=>{m.success("\u63D0\u4EA4\u6210\u529F"),this.data={},console.log(d)},onError:d=>{console.log(d),m.error("\u63D0\u4EA4\u5931\u6557")}})}).catch(d=>{console.log(d),m.error("\u63D0\u4EA4\u5931\u6557")})}}},C=s("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"\u6703\u54E1\u7533\u8ACB",-1),z={class:"max-w-6xl mx-auto p-4"},M={class:"rounded-md bg-white shadow-md p-12"},B={key:0},N=s("div",{class:"font-bold text-2xl mb-4"},"\u6703\u54E1\u7533\u8ACB\u8868",-1),R={class:"flex flex-col"},Y={class:"flex justify-between gap-3"},j={class:"flex-auto w-3/4"},D={class:"flex-auto w-1/4"},L={class:"flex justify-end"},V={key:1},W=s("div",{class:"text-center font-bold text-3xl"},"\u4F60\u5DF2\u63D0\u4EA4\u7533\u8ACB",-1),E=[W];function F(d,l,u,T,e,c){const r=i("a-input"),n=i("a-form-item"),_=i("a-select"),b=i("a-date-picker"),f=i("a-button"),h=i("a-form"),x=i("WebLayout");return p(),q(x,{title:"\u6703\u54E1\u7533\u8ACB"},{header:o(()=>[C]),default:o(()=>[s("div",z,[s("div",M,[u.member_application?(p(),v("div",V,E)):(p(),v("div",B,[N,t(h,{ref:"modalRef",model:e.data,name:"Teacher",autocomplete:"off",layout:"horizontal",rules:e.rules,"label-col":e.labelCol,"validate-messages":e.validateMessages},{default:o(()=>[s("div",R,[s("div",Y,[s("div",j,[t(n,{label:"\u4E2D\u6587\u59D3\u540D",name:"name_zh"},{default:o(()=>[t(r,{value:e.data.name_zh,"onUpdate:value":l[0]||(l[0]=a=>e.data.name_zh=a)},null,8,["value"])]),_:1})]),s("div",D,[t(n,{label:"\u6027\u5225",name:"gender"},{default:o(()=>[t(_,{options:u.gender,value:e.data.gender,"onUpdate:value":l[1]||(l[1]=a=>e.data.gender=a)},null,8,["options","value"])]),_:1})])]),t(n,{label:"\u82F1\u6587\u59D3\u540D",name:"name_en"},{default:o(()=>[t(r,{value:e.data.name_en,"onUpdate:value":l[2]||(l[2]=a=>e.data.name_en=a)},null,8,["value"])]),_:1}),t(n,{label:"\u51FA\u751F\u65E5\u671F",name:"birth"},{default:o(()=>[t(b,{value:e.data.birth,"onUpdate:value":l[3]||(l[3]=a=>e.data.birth=a),valueFormat:"YYYY-MM-DD"},null,8,["value"])]),_:1}),t(n,{label:"\u901A\u8FC5\u5730\u5740",name:"address"},{default:o(()=>[t(r,{value:e.data.address,"onUpdate:value":l[4]||(l[4]=a=>e.data.address=a)},null,8,["value"])]),_:1}),t(n,{label:"\u806F\u7D61\u96FB\u8A71",name:"phone"},{default:o(()=>[t(r,{value:e.data.phone,"onUpdate:value":l[5]||(l[5]=a=>e.data.phone=a)},null,8,["value"])]),_:1}),t(n,{label:"\u96FB\u5B50\u90F5\u7BB1",name:"email"},{default:o(()=>[t(r,{value:e.data.email,"onUpdate:value":l[6]||(l[6]=a=>e.data.email=a)},null,8,["value"])]),_:1}),t(n,{label:"\u5DE5\u4F5C\u6A5F\u69CB",name:"company"},{default:o(()=>[t(r,{value:e.data.company,"onUpdate:value":l[7]||(l[7]=a=>e.data.company=a)},null,8,["value"])]),_:1}),t(n,{label:"\u8077\u4F4D",name:"position"},{default:o(()=>[t(r,{value:e.data.position,"onUpdate:value":l[8]||(l[8]=a=>e.data.position=a)},null,8,["value"])]),_:1}),t(n,{label:"\u7533\u8ACB\u6703\u7C4D",name:"membership_level"},{default:o(()=>[t(_,{options:u.membership_levels,value:e.data.membership_level,"onUpdate:value":l[9]||(l[9]=a=>e.data.membership_level=a)},null,8,["options","value"])]),_:1})]),s("div",L,[t(f,{type:"primary",onClick:c.storeRecord},{default:o(()=>[U("\u63D0\u4EA4")]),_:1},8,["onClick"])])]),_:1},8,["model","rules","label-col","validate-messages"])]))])])]),_:1})}const K=k(w,[["render",F]]);export{K as default};
