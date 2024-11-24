import{l as n,m,c as y,a as k,w as g,x as d,o as v,b as r,f as x,i as u,s as c,k as w}from"./app-DQs3gJAQ.js";import{_ as h}from"./AuthenticatedLayout-D8X1uTUX.js";import"./ApplicationLogo-Cu1tKf1_.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const _={class:"flex justify-center"},B={class:"w-[75%]"},P={class:"mb-4"},S={class:"mb-4"},E={class:"mb-4"},M={__name:"BuyersPreference",setup(I){const a=n(""),s=n(""),l=n(""),f=n(null),b=async()=>{try{const t=await d.get("/api/user",{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`}});f.value=t.data.id}catch(t){console.error("Error fetching user ID:",t)}},i=async()=>{try{const e=(await d.get("/api/buyers_preference",{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`}})).data;console.log(e),e&&(a.value=e.preferred_weight,s.value=e.age_of_pigs,l.value=e.price_range)}catch(t){console.error("Error fetching buyer preferences:",t)}},p=async()=>{try{const t=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),e=await d.post("/api/buyers_preference",{preferred_weight:a.value,age_of_pigs:s.value,price_range:l.value},{headers:{"Content-Type":"application/json","X-CSRF-TOKEN":t,Authorization:`Bearer ${localStorage.getItem("token")}`}});if(e.status!==200)throw new Error("Network response was not ok");const o=e.data;console.log("Form submitted successfully:",o),await i()}catch(t){console.error("Error submitting form:",t)}};return m(()=>{b(),i()}),(t,e)=>(v(),y("div",null,[k(h,null,{header:g(()=>e[3]||(e[3]=[r("h2",{class:"font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"},"Buyer Preferences",-1)])),default:g(()=>[r("main",null,[r("div",_,[r("div",B,[r("form",{onSubmit:x(p,["prevent"]),class:"place-content-center"},[r("div",P,[e[4]||(e[4]=r("label",{for:"preferredWeight",class:"block text-sm font-medium text-gray-700 dark:text-gray-300"},"Preferred Weight",-1)),u(r("input",{type:"text",id:"preferredWeight","onUpdate:modelValue":e[0]||(e[0]=o=>a.value=o),class:"mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"},null,512),[[c,a.value]])]),r("div",S,[e[6]||(e[6]=r("label",{for:"ageOfPigs",class:"block text-sm font-medium text-gray-700 dark:text-gray-300"},"Age of Pigs (in months)",-1)),u(r("select",{id:"ageOfPigs","onUpdate:modelValue":e[1]||(e[1]=o=>s.value=o),class:"mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"},e[5]||(e[5]=[r("option",{value:"1"},"1",-1),r("option",{value:"2"},"2",-1),r("option",{value:"3"},"3",-1),r("option",{value:"4"},"4",-1),r("option",{value:"5"},"5",-1),r("option",{value:"6"},"6",-1),r("option",{value:"Older"},"Older",-1)]),512),[[w,s.value]])]),r("div",E,[e[7]||(e[7]=r("label",{for:"priceRange",class:"block text-sm font-medium text-gray-700 dark:text-gray-300"},"Price Range",-1)),u(r("input",{type:"text",id:"priceRange","onUpdate:modelValue":e[2]||(e[2]=o=>l.value=o),class:"mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"},null,512),[[c,l.value]])]),e[8]||(e[8]=r("button",{type:"submit",class:"w-full bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800"},"Submit",-1))],32)])])])]),_:1})]))}};export{M as default};
