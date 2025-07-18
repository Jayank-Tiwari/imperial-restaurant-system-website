 @extends('layout.app')

@section('title', 'About - Imperial Spice')
@section('active', 'about')

@section('content')

 
 <div class="px-40 flex flex-1 justify-center py-5">
     <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
         <div class="@container">
             <div class="@[480px]:px-4 @[480px]:py-3">
                 <div class="bg-cover bg-center flex flex-col justify-end overflow-hidden bg-[#fbf9f9] @[480px]:rounded-xl min-h-80"
                     style='background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0) 25%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTGQMG-JocQ0DAjslMeLC2g-Eowak2IMlUvElfozvV6sZ5_zB6ytgp57hHNMIQx0dtDiJGlpXdZApcI1J7dXK_bjpensLY58cX-sMqiH37J97qrs0tMPuj5Ov9no4zHXpYKIqF3rARNxq15afjrVF0JG3a3NM3zC3IjvJIHSEkP78m4Ga4zA1vcnA_Mx40udZ3SyVMZ8oV7xzJEiVLyEjbMfaR_m81IXtWGGjz1UU_lftyepZgDTVGbfjxXH_SG1kzm8v4i9kKCsE");'>
                     <div class="flex p-4">
                         <p class="text-white tracking-light text-[28px] font-bold leading-tight">Our Story</p>
                     </div>
                 </div>
             </div>
         </div>
         <p class="text-[#191011] text-base font-normal leading-normal pb-3 pt-1 px-4">
             At Flavors, our journey began with a simple passion: to create a dining experience that transcends the
             ordinary. Inspired by the rich culinary traditions of the
             Mediterranean, we embarked on a quest to source the finest ingredients and craft dishes that celebrate the
             vibrant flavors of the region. Our story is one of
             dedication, innovation, and a commitment to excellence, ensuring every meal is a memorable occasion.
         </p>
         <h2 class="text-[#191011] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Meet Our Team
         </h2>
         <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
             <div class="flex flex-col gap-3 pb-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDXiuogtqq1ASViKoJldN50XYlr9xkXYanLiVebPkvAxF4uVr1AhuFtGW08AjC0x8JEZTc0Et8b7RkR6XUHLcyW8qWePHnKWBZVgx7fG2jGYclQkA9jawFz5jrcqSqg5-hWR60HPQitHK1s14SXEpRkE_C0ksGgr9bMdgUWjkmxYfUXMho7Fi8uQdWiZgzVdWkGpVYRaf-pJlq-8Uo_aNjq5NhGftpl4L85WmQ0S77atYHxApmkZWGHakyYTnHhYx8A7ZcGBMvgKj4");'>
                 </div>
                 <div>
                     <p class="text-[#191011] text-base font-medium leading-normal">Chef Isabella Rossi</p>
                     <p class="text-[#8b5b5d] text-sm font-normal leading-normal">Executive Chef</p>
                 </div>
             </div>
             <div class="flex flex-col gap-3 pb-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCPkZZu9OZ6qxQOPP70fI2-xS_H0M57MmfpKgDYTxQA6xfig9ysIg244Hg6hF6jSopgwleeHM5EkL4jXqY_vtzK7-Bbv4tpGgFXO4NDdtn0WmjbVEpux4_5K_gSskSkOAVQ7vWViwTP1RzUU_wkuNq5bbC8318Z9x5aZd3Uf-PgRmVG-R-aJerebjkhnYMvANEGI8k9warmS8CKp5IFEpAvtVh3oXMT5FL0WYQRPQsd6sHBUbbIpRPbacDknXg6bKYoMQ5cnZr4CIU");'>
                 </div>
                 <div>
                     <p class="text-[#191011] text-base font-medium leading-normal">Chef Marco Bianchi</p>
                     <p class="text-[#8b5b5d] text-sm font-normal leading-normal">Sous Chef</p>
                 </div>
             </div>
             <div class="flex flex-col gap-3 pb-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBf_RIsZnwa_ym-YSEZ8PHgp0cmS3_8Q9Gg5xdg4me8G0a-TZ7aUx7kquvKZc5h9mCrKyPXgK7gx9Nip1JQw3uS5CVo7tnCvYx34r_AF5WGGBYP69g2MKBsX8yIRNjrIiMdrtWB5GXwQ-PzLGnta8toudW-vENyh6mxUKiB6T32xdl6GaoRh5BeCMGSwY0JtxEbPjkYmYSSTnnH35dwvbVZOgvZ4Yq15q7ir5mL_KuGeZYQFV225d1bLE2kWj74EEE66yAs5gTKaBk");'>
                 </div>
                 <div>
                     <p class="text-[#191011] text-base font-medium leading-normal">Chef Sofia Lombardi</p>
                     <p class="text-[#8b5b5d] text-sm font-normal leading-normal">Pastry Chef</p>
                 </div>
             </div>
         </div>
         <h2 class="text-[#191011] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Our Space
         </h2>
         <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
             <div class="flex flex-col gap-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBlDxqZiukdNv2b_8-9pW2n_eB2ekNMRazcD22SSCTRv5FgQepifkZkEDrtt65I1vRH3FpqWDOx-LH6RoXQYYHySSyR9fDRVek5DAqKeNKtsdboYOJL-hNW01-GBUrF4LwBIoGZsBz7CDY11yxTSTc1cOsxjzeN-gFVyi8sOF-2-gPB6a2odRKOy3oyQtq-Awvkuqf0XbkQIfHAmayiqR-mlnmZzUWLve8MIaGqXO6bK-FF55W3Jgf_zNPbDLzPz-xNoUnr7uxbvbY");'>
                 </div>
             </div>
             <div class="flex flex-col gap-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuASJn-KoN5Zhtqeos1OMO9k11DI1On1oGR-aNYmesfiZg9vxSwLbaBajmXyOltZvyrbKYAIquPbSgRKJ-vLJH5LnGc8ojI3axyVAj_mj0baxoVXxAMtves5QHkNgnN_-a4T71E2CL7kVmYuEUEvp2JLgsc-AHQaIhbMecDkdbB1Xi41kwDrpviKwfC9XugLkh7FgP2_cUWmDmnUvuYCDm65zGQ3Akcf5pvt31B4UTI69UCOkyMNy3tCy9MsWVsImkaW-Gggdjk8S2s");'>
                 </div>
             </div>
             <div class="flex flex-col gap-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC6WLCtz4S8BXqgiQPDELQ5plFPAHNBh3pRiNkweNCq7W8FtMK6s7YjHLXDObhAUh7eT38bzhDcEAxDj7z7UJ4I_F0Ykc2C6HXaSLcmCDeV-o8-snNStUuvrt5T1iXOHR8mBIJUL0AN6OWKUzNyw5pWL3vh8gILGaaRBEGkY11j8juxp96ssiCVVH15CMIgxDjGBTHnh4pC1wMh6qqqxTCDL2-7HU3ua7spvBySrNcSVtoviR9gnnttIvAECYqUKKOwSquuHlBXQ7A");'>
                 </div>
             </div>
             <div class="flex flex-col gap-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDCa8_n49io02li6t31x6l32W0gNJQz9-RDY7x6OWIXr6KFjcWfZJS3X9jNhmFikmmoSPKTPuM_M2KvEJvrEGZBIPeHp-HTfzTJ_Av5VWxfOM6IuSY0Rh6fM_vJAQ_KplCkyzPobrlIZp6cJM1AC5AEw4-iFdWkPJgzajjAbsyRfjQVVDCwNIU_N3iMgUNqNFSpj1RisMnqLsX6lk7bWUV_gsqwj-DPXqU5HqiUyVl1ZJrUAvGfzKlEbBwc9wu7E_FmUAk_kyu7O3w");'>
                 </div>
             </div>
             <div class="flex flex-col gap-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDetQzol88boIfiyQmNsBlex56M3rBKHsyklrTlcgDxVz8GL0Oy8lpRN0HL0D-zZdiVHFz9w5q-1qmmMHnvfRJreg1SrRRsvnVaISwuVjD66UzKVtHtVUshP7AWniW9W1GSHFOOzeVhRNf4FVMsUdUuG8yxO8N0wFI7hU66uD8AwNJ2q6TTzeOTFmq0t5Mn02Sm_w7pmRfftfv534tyOjEdFLIraHsbQoqMxjT3cX0Nhw32SIHuk8GuQbnxSgyruJtUunnJCtHGWEY");'>
                 </div>
             </div>
             <div class="flex flex-col gap-3">
                 <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDHiPAfzl0m__P7zdJDiO4HkWbwyiSOcT6EhJmjbnN3MyUIiytQn9OwzjLOcUL-2p4E3wtlWWhCAYAbcBvGH7X0MGOf5xaPjEV9nlUTNnFz6NfSx3r28jUk8BzdSLsRDe0RJ1CjCNcxHhxXiW8y-v4YrsgQ_3gKOflh8xECVIH8y6TWBDiKhQn1zqWajYvRd9L7j6FKTjz7Q_QLZ5gdhV6Dr3-cq-adlm5DgrnxuCA_mwhV8HNXLQ7kQpY5vz2ifikP-5OGizJWqqs");'>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @endsection