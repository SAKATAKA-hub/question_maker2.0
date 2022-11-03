{
    'use strict';


    /**
     * ==============================
     *  フェードインアニメーション
     * ==============================
    */
    // Windowの高さ

    // アニメーション対象クラスと、追加クラス
    const animation_class =[


        /* 上からフェードイン01 */
        {
            target: '.'+'anm_top_s01',
            add: 'anm_top_e01',
        },
        /* 上からフェードイン02 */
        {
            target: '.'+'anm_top_s02',
            add: 'anm_top_e02',
        },


        /* 斜め上からフェードイン01 */
        {
            target: '.'+'anm_uphill_s01',
            add: 'anm_uphill_e01',
        },
        /* 斜め上からフェードイン02 */
        {
            target: '.'+'anm_uphill_s02',
            add: 'anm_uphill_e02',
        },



        /* 左からフェードイン01 */
        {
            target: '.'+'anm_left_s01',
            add: 'anm_left_e01',
        },
        /* 左からフェードイン02 */
        {
            target: '.'+'anm_left_s02',
            add: 'anm_left_e02',
        },



        /* 下からフェードイン01 */
        {
            target: '.'+'anm_bottom_s01',
            add: 'anm_bottom_e01',
        },
        /* 下からフェードイン02 */
        {
            target: '.'+'anm_bottom_s02',
            add: 'anm_bottom_e02',
        },
        /* 下からフェードイン03 */
        {
            target: '.'+'anm_bottom_s03',
            add: 'anm_bottom_e03',
        },

        /* 拡大フェードイン01 */
        {
            target: '.'+'anm_scale_s01',
            add: 'anm_scale_e01',
        },
        /* 拡大フェードイン02 */
        {
            target: '.'+'anm_scale_s02',
            add: 'anm_scale_e02',
        },

    ];



    // Windowがスクロールしたとき
    window.addEventListener('scroll', function(){

        // アニメーション実行関数
        playAnimations();

    });//end window.addEventListener 'scroll'


    // Windowが読込まれたとき
    window.addEventListener('load', function(){

        // Loadingのフェードアウト実行
        window.setTimeout( splashFadeOut, 1500 );

        // アニメーション実行関数
        window.setTimeout( playAnimations, 2000 );

    });


    // Loadingのフェードアウト実行
    const splashFadeOut = function(){

        // フェードアウトアニメーション
        const target_class = '.'+'fadeUOut';
        const add_class = "anm_fadeUOut";
        let element = document.querySelector( target_class );
        if( !element.classList.contains( add_class ) ){
            element.classList.add( add_class );// アニメーションクラスの追加
        }

        // アニメーション実行関数
        // playAnimations();
    }



    // アニメーション実行関数
    const playAnimations = function(){


        // 各対象クラスの処理を実行
        animation_class.forEach(animation_class => {

            let elements = document.querySelectorAll( animation_class.target );
            elements.forEach(element => {

                let element_top = element.getBoundingClientRect().top;
                let add_class = animation_class.add;

                /*
                 * (対象要素の上部が、Windowの上部を通過したたとき)かつ
                 * (対象要素にクラスが追加されていないとき)
                 *
                */
                if(element_top + 50 < window.innerHeight){

                    if( !element.classList.contains( add_class ) ){

                        element.classList.add( add_class );// アニメーションクラスの追加
                    }

                }else{

                    if( element.classList.contains( add_class ) ){

                        element.classList.remove( add_class );// アニメーションクラスの削除
                    }

                }

            });//end elements.forEach

        });//end animation_class.forEach


    };

}
