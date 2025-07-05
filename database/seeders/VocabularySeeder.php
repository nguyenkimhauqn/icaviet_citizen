<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VocabularyTopic;
use App\Models\VocabularyCategory;
use App\Models\Vocabulary;

class VocabularySeeder extends Seeder
{
    public function run(): void
    {
        $topic = VocabularyTopic::firstOrCreate([
            'name' => 'Từ vựng chung',
            'slug' => 'general'
        ]);

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => 'Tổng quan',
            'slug' => 'general'
        ]);

        $vocabularies = [
            [
                'word' => 'Advice',
                'meaning' => 'Khuyên',
                'hint' => 'ợt-vai-(s)',
                'example' => 'The Cabinet <strong>advises</strong> the President.',
            ],
            [
                'word' => 'Amendment',
                'meaning' => 'Tu chính án, một phần sửa đổi, bổ sung (trong Hiến pháp)',
                'hint' => 'ờ-men-mần-(t)',
                'example' => 'An <strong>Amendment</strong> is a change.',
            ],
            [
                'word' => 'America/United States',
                'meaning' => 'Hoa Kỳ',
                'hint' => null,
                'example' => 'Americans can vote.',
            ],
            [
                'word' => 'American Indians',
                'meaning' => 'Người da đỏ bản địa Mỹ',
                'hint' => 'ờ-me-ri-cần in-đi-ần-(s)',
                'example' => '<strong>American Indians</strong> lived in America before the Europeans arrived.',
            ],
            [
                'word' => 'Because',
                'meaning' => 'bởi vì',
                'hint' => 'bì-khơ-(s)',
                'example' => 'Some states have more Representatives than other states <strong>Because</strong> they have more people.',
            ],
            [
                'word' => 'Before',
                'meaning' => 'trước khi',
                'hint' => 'bì-pho',
                'example' => 'American Indians lived in America <strong>Before</strong> the Europeans arrived.',
            ],
            [
                'word' => 'Bill/bills',
                'meaning' => 'dự luật',
                'hint' => 'biu',
                'example' => 'The <strong>Bill</strong> of Rights.',
            ],
            [
                'word' => 'Border',
                'meaning' => 'giáp biên giới',
                'hint' => 'boa-đờ',
                'example' => 'New York borders Canada.',
            ],
            [
                'word' => 'Branch',
                'meaning' => 'nhánh',
                'hint' => 'b-ranh-(ch)',
                'example' => 'The judicial <strong>Branch</strong> reviews laws.',
            ],
            [
                'word' => 'Cabinet',
                'meaning' => 'Nội các',
                'hint' => 'ca-bơ-nợt',
                'example' => '<strong>Cabinet</strong> advises the President.',
            ],
            [
                'word' => 'Capital',
                'meaning' => 'thủ đô, thủ phủ',
                'hint' => 'cáp-pi-đồ',
                'example' => 'Washington, D.C. is the <strong>Capital</strong> of the United States.',
            ],
            [
                'word' => 'Capitalist economy',
                'meaning' => 'kinh tế thị trường',
                'hint' => 'cáp-pi-đồ-lịt-(s) i-có-no-mi',
                'example' => '<strong>Capitalist economy</strong> is the economic system in the United States.',
            ],
            [
                'word' => 'Change',
                'meaning' => 'thay đổi',
                'hint' => 'cheng-(ch)',
                'example' => 'An amendment is a <strong>Change</strong>.',
            ],
            [
                'word' => 'Checks and balances',
                'meaning' => 'kiểm tra và cân bằng',
                'hint' => 'chéc-(k) en bá-lềnh-xịt-(s)',
                'example' => '<strong>Checks and balances</strong> stop one branch of government from becoming too powerful.',
            ],
            [
                'word' => 'Chief Justice',
                'meaning' => 'Chánh án, người đứng đầu Tòa án Tối cao',
                'hint' => 'chip-(ph) chớt-s-tịc-(s)',
                'example' => 'John Roberts is the <strong>Chief Justice</strong> now.',
            ],
            [
                'word' => 'Civil rights',
                'meaning' => 'dân quyền',
                'hint' => 'si-vồ rai-(s)',
                'example' => '<strong>Civil rights</strong> tried to end racial discrimination.',
            ],
            [
                'word' => 'Civil War',
                'meaning' => 'Nội chiến',
                'hint' => 'si-vồ quo-(r)',
                'example' => '<strong>Civil War</strong> is the U.S. war between the North and the South.',
            ],
            [
                'word' => 'Cold War',
                'meaning' => 'Chiến tranh lạnh',
                'hint' => 'câu-(d) quo-(r)',
                'example' => 'During the <strong>Cold War</strong>, Communism was the main concern of the United States.',
            ],
            [
                'word' => 'Colonists',
                'meaning' => 'những người thực dân',
                'hint' => 'có-lơ-nịt-(s)',
                'example' => 'The <strong>Colonists</strong> fought the British because of high taxes.',
            ],
            [
                'word' => 'Commander in Chief',
                'meaning' => 'Tổng Chỉ huy, Tổng Tư lệnh',
                'hint' => 'cờ-mán-đờ in chíp-(ph)',
                'example' => 'The President is the <strong>Commander in Chief</strong> of the military.',
            ],
            [
                'word' => 'Congress',
                'meaning' => 'Quốc hội',
                'hint' => 'cón-g-rẹt-(s)',
                'example' => '<strong>Congress</strong> makes federal laws.',
            ],
            [
                'word' => 'Constitution',
                'meaning' => 'Hiến pháp',
                'hint' => 'con-sti-tíu-sần',
                'example' => '<strong>Constitution</strong> is the supreme law of the land.',
            ],
            [
                'word' => 'Constitutional Convention',
                'meaning' => 'Hội nghị Lập hiến (lập ra Hiến pháp)',
                'hint' => 'con-sti-tíu-sần-nồ cần-ven-sần',
                'example' => 'The Constitution was written at the <strong>Constitutional Convention</strong>.',
            ],
            [
                'word' => 'Declaration of Independence',
                'meaning' => 'Tuyên ngôn Độc lập',
                'hint' => 'đe-cle-ray-sần ợp in-đì-pen-đần-(s)',
                'example' => 'The <strong>Declaration of Independence</strong> announced our independence.',
            ],
            [
                'word' => 'Democracy',
                'meaning' => 'nền dân chủ, tự do (phân biệt với Democratic Party - Đảng Dân chủ)',
                'hint' => 'đì-ma-c-ra-si',
                'example' => 'Americans can vote to participate in their <strong>Democracy</strong>.',
            ],
            [
                'word' => 'Democratic Party',
                'meaning' => 'Đảng Dân chủ',
                'hint' => 'đe-mờ-rá-đic pa-đi',
                'example' => 'Democratic and Republican are the two major political parties in the United States.',
            ],
            [
                'word' => 'Driver’s license',
                'meaning' => 'giấy phép lái xe',
                'hint' => 'đ-rai-vờ-(s) lai-sần-(s)',
                'example' => 'The state can give driver’s licenses.',
            ],
            [
                'word' => 'East Coast',
                'meaning' => 'bờ Đông',
                'hint' => 'it-s-(t) câu-s-(t)',
                'example' => 'Atlantic (Ocean) is on the <strong>East Coast</strong> of the United States.',
            ],
            [
                'word' => 'Elect/election',
                'meaning' => 'bầu cử',
                'hint' => 'ì-léc-(t) / ì-léc-sần',
                'example' => 'We <strong>Elect</strong> a President for 4 years.',
            ],
            [
                'word' => 'Europeans',
                'meaning' => 'người Châu Âu',
                'hint' => 'diu-róp-pi-ân-(s)',
                'example' => 'American Indians lived in America before the <strong>Europeans</strong> arrived.',
            ],
            [
                'word' => 'Everyone',
                'meaning' => 'mọi người',
                'hint' => 'e-v-ri-quan',
                'example' => '<strong>Everyone</strong> must follow the law.',
            ],
            [
                'word' => 'Executive Branch',
                'meaning' => 'nhánh Hành pháp',
                'hint' => 'ịt-xe-cơ-đi-(v) b-ran-(ch)',
                'example' => 'The President is in charge of the <strong>Executive Branch</strong>.',
            ],
            [
                'word' => 'Father of Our Country',
                'meaning' => 'Người Cha của Đất nước',
                'hint' => 'pha-đờ ợp ao-ờ cân-tri',
                'example' => 'George Washington is the “<strong>Father of Our Country</strong>”.',
            ],
            [
                'word' => 'Federal',
                'meaning' => 'liên bang',
                'hint' => 'phé-đơ-rồ',
                'example' => 'Congress makes <strong>Federal</strong> laws.',
            ],
            [
                'word' => 'Federal government',
                'meaning' => 'chính phủ liên bang',
                'hint' => 'phé-đơ-rồ gó-vơ-mần-(t)',
                'example' => 'One power of the <strong>Federal government</strong> is to print money.',
            ],
            [
                'word' => 'Federal laws',
                'meaning' => 'luật liên bang',
                'hint' => 'phé-đơ-rồ lo-(s)',
                'example' => 'Congress makes <strong>Federal laws</strong>.',
            ],
            [
                'word' => 'Federalist Papers',
                'meaning' => 'tuyển tập các bài tham luận kêu gọi ủng hộ Hiến pháp.',
                'hint' => 'phé-đơ-rồ-lịt-s-(t) pay-pờ-(s)',
                'example' => 'James Madison helped write The <strong>Federalist Papers</strong>.',
            ],
            [
                'word' => 'Fight/fought',
                'meaning' => 'chiến đấu, chống lại',
                'hint' => 'phai-(t)/phót-(t)',
                'example' => 'Susan B. Anthony <strong>fought</strong> for women’s rights.',
            ],
            [
                'word' => 'First',
                'meaning' => 'đầu tiên',
                'hint' => 'phớt-s-(t)',
                'example' => 'George Washington was the <strong>First</strong> president.',
            ],
            [
                'word' => 'First three words',
                'meaning' => '3 chữ đầu tiên',
                'hint' => 'phớt-s-(t) th-ri quợt-(s)',
                'example' => 'We the People are the <strong>First three words</strong> in the Constitution.',
            ],
            [
                'word' => 'Flag',
                'meaning' => 'lá cờ',
                'hint' => 'ph-lát-g',
                'example' => 'The <strong>Flag</strong> have 50 stars because there are 50 states.',
            ],
            [
                'word' => 'Follow',
                'meaning' => 'làm theo, tuân theo',
                'hint' => 'pho-lâu',
                'example' => 'Everyone must <strong>Follow</strong> the law',
            ],
            [
                'word' => 'France',
                'meaning' => 'Pháp',
                'hint' => 'ph-ren-(s)',
                'example' => 'The United States bought Louisiana from <strong>France</strong>.',
            ],
            [
                'word' => 'Freedom',
                'meaning' => 'tự do',
                'hint' => 'ph-ri-đầm',
                'example' => '<strong>Freedom</strong> is one reason colonists came to America.',
            ],
            [
                'word' => 'Freedom of religion',
                'meaning' => 'tự do tôn giáo',
                'hint' => 'ph-ri-đầm ợp rì-li-chần',
                'example' => 'One right of everyone the United States is <strong>Freedom of religion</strong>.',
            ],
            [
                'word' => 'Freedom of speech',
                'meaning' => 'tự do ngôn luận',
                'hint' => 'ph-ri-đầm ợp s-pít-(ch)',
                'example' => 'One right of everyone the United States is <strong>Freedom of speech</strong>.',
            ],
            [
                'word' => 'Germany',
                'meaning' => 'Đức',
                'hint' => 'chớ-ma-ni',
                'example' => 'The United States fought Japan, <strong>Germany</strong>, and Italy in World War II.',
            ],
            [
                'word' => 'Governor',
                'meaning' => 'Thống đốc',
                'hint' => 'gó-vơ-nờ',
                'example' => 'Who is the <strong>Governor</strong> of your state now?',
            ],
            [
                'word' => 'House of Representatives',
                'meaning' => 'Hạ viện',
                'hint' => 'hao-(s) ợp re-prì-sen-tơ-ti-(s)',
                'example' => 'The <strong>House of Representatives</strong> has 435 voting members.',
            ],
            [
                'word' => 'How many',
                'meaning' => 'có bao nhiêu',
                'hint' => 'hao men-ni',
                'example' => '<strong>How many</strong> U.S. Senators are there?',
            ],
            [
                'word' => 'How many years',
                'meaning' => 'bao nhiêu năm',
                'hint' => 'hao men-ni dia-(s)',
                'example' => 'We elect a U.S. Senator for <strong>How many years</strong>?',
            ],
            [
                'word' => 'How old',
                'meaning' => 'bao nhiêu tuổi',
                'hint' => 'hao âu-(d)',
                'example' => '<strong>How old</strong> do citizens have to be to vote for President?',
            ],
            [
                'word' => 'Independence Day',
                'meaning' => 'Lễ Độc lập',
                'hint' => 'in-đì-pen-đần-(s) đay',
                'example' => '<strong>Independence Day</strong> is on July 4',
            ],
            [
                'word' => 'Italy',
                'meaning' => 'Ý',
                'hint' => 'i-tơ-li',
                'example' => 'The United States fought Japan, Germany, and <strong>Italy</strong> in World War II.',
            ],
            [
                'word' => 'Japan',
                'meaning' => 'Nhật Bản',
                'hint' => 'chờ-pan',
                'example' => 'The United States fought <strong>Japan</strong>, Germany, and Italy in World War II.',
            ],
            [
                'word' => 'Join',
                'meaning' => 'tham gia',
                'hint' => 'choi-(ền)',
                'example' => 'Americans can <strong>Join</strong> a political party.',
            ],
            [
                'word' => 'Judicial Branch',
                'meaning' => 'Nhánh Tư pháp',
                'hint' => 'chu-đi-sồ b-ran-(ch)',
                'example' => '<strong>Judicial Branch</strong> reviews laws.',
            ],
            [
                'word' => 'Justice/justices',
                'meaning' => 'thẩm phán',
                'hint' => 'chớt-tịc-(s) / chớt-tịc-sịt-(s)',
                'example' => 'How many <strong>justices</strong> are on the Supreme Court?',
            ],
            [
                'word' => 'Law',
                'meaning' => 'luật',
                'hint' => 'lo',
                'example' => 'Everyone must follow the <strong>Law</strong>.',
            ],
            [
                'word' => 'Liberty',
                'meaning' => 'tự do',
                'hint' => 'lí-bơ-đi',
                'example' => 'The Statue of <strong>Liberty</strong> is in New York Harbor.',
            ],
            [
                'word' => 'Longest river',
                'meaning' => 'con sông dài nhất',
                'hint' => 'lon-gịt-s-(t) ri-vờ',
                'example' => 'Missouri River is one of the <strong>Longest river</strong> in the United States.',
            ],
            [
                'word' => 'Loyal/loyalty',
                'meaning' => 'trung thành, lòng trung thành',
                'hint' => 'loi-ồ',
                'example' => 'U.S. citizens promise to be <strong>Loyal</strong> to the United States.',
            ],
            [
                'word' => 'Men',
                'meaning' => 'nam giới',
                'hint' => 'men',
                'example' => 'All <strong>Men</strong> must register for the Selective Service at age eighteen.',
            ],
            [
                'word' => 'Military',
                'meaning' => 'quân đội',
                'hint' => 'mí-lơ-te-ri',
                'example' => 'The President is the Commander in Chief of the <strong>Military</strong>.',
            ],
            [
                'word' => 'Movement',
                'meaning' => 'phong trào',
                'hint' => 'mu-v-mần-(t)',
                'example' => 'What <strong>Movement</strong> tried to end racial discrimination?',
            ],
            [
                'word' => 'Name',
                'meaning' => 'tên (danh từ)',
                'hint' => 'nem',
                'example' => 'What is the name of the President of the United States now?',
            ],
            [
                'word' => 'Name',
                'meaning' => 'kể tên (động từ)',
                'hint' => 'nem',
                'example' => 'Name one right only for United States citizens.',
            ],
            [
                'word' => 'National anthem',
                'meaning' => 'quốc ca',
                'hint' => 'ná-sân-nồ an-thầm',
                'example' => 'The Star-Spangled Banner is the name of the <strong>National anthem</strong>.',
            ],
            [
                'word' => 'National U.S. holiday',
                'meaning' => 'ngày lễ quốc gia',
                'hint' => 'ná-sân-nồ diu-ét-(s) ho-li-đây',
                'example' => 'Christmas is a <strong>National U.S. holiday</strong>.',
            ],
            [
                'word' => 'New Year’s Day',
                'meaning' => 'năm mới',
                'hint' => 'niu dia-(s) đay',
                'example' => '<strong>New Year’s Day</strong> is a national U.S. holiday.',
            ],
            [
                'word' => 'No longer serve',
                'meaning' => 'không thể tiếp tục làm việc',
                'hint' => 'nâu lon-gờ sơ-v',
                'example' => 'If the President can <strong>No longer serve</strong>, the Vice President becomes President.',
            ],
            [
                'word' => 'North',
                'meaning' => 'miền bắc',
                'hint' => 'no-(th)',
                'example' => 'Canada is to the <strong>North</strong> of the United States.',
            ],
            [
                'word' => 'Now',
                'meaning' => 'hiện tại',
                'hint' => 'nao',
                'example' => 'What is the name of the President of the United States <strong>Now</strong>?',
            ],
            [
                'word' => 'Ocean',
                'meaning' => 'đại dương',
                'hint' => 'âu-sần',
                'example' => 'Pacific <strong>Ocean</strong> is on the West Coast of the United States.',
            ],
            [
                'word' => 'Only',
                'meaning' => 'chỉ riêng',
                'hint' => 'on-li',
                'example' => '<strong>Only</strong> United States citizens can vote in a federal election.',
            ],
            [
                'word' => 'People',
                'meaning' => 'người',
                'hint' => 'pi-pồ',
                'example' => 'We the <strong>People</strong>',
            ],
            [
                'word' => 'Pledge of Allegiance',
                'meaning' => 'Lời tuyên thệ trung thành',
                'hint' => 'p-lét-(ch) ợp ờ-lí-chần-(s)',
                'example' => 'We show loyalty to the United States when we say the <strong>Pledge of Allegiance</strong>.',
            ],
            [
                'word' => 'Political party',
                'meaning' => 'đảng',
                'hint' => 'pờ-lí-đi-cồ pa-đì',
                'example' => 'Americans can join a <strong>Political party</strong>.',
            ],
            [
                'word' => 'Power',
                'meaning' => 'quyền lực',
                'hint' => 'pao-quờ',
                'example' => 'One <strong>Power</strong> of the federal government is to print money.',
            ],
            [
                'word' => 'Practice any religion',
                'meaning' => 'theo một tôn giáo',
                'hint' => 'p-rát-tịt-(s) én-ni rì-li-chần',
                'example' => 'You can <strong>Practice any religion</strong>, or not practice a religion',
            ],
            [
                'word' => 'President',
                'meaning' => 'Tổng thống',
                'hint' => 'p-ré-gi-đềnh-(t)',
                'example' => 'The <strong>President</strong> is in charge of the Executive Branch.',
            ],
            [
                'word' => 'Print money',
                'meaning' => 'in tiền',
                'hint' => 'p-rin-(t) mân-ni',
                'example' => 'One power of the federal government is to <strong>Print money</strong>.',
            ],
            [
                'word' => 'Promise',
                'meaning' => 'hứa, lời hứa',
                'hint' => 'p-ró-mịt-(s)',
                'example' => 'U.S. citizens <strong>Promise</strong> to be loyal to the United States.',
            ],
            [
                'word' => 'Racial discrimination',
                'meaning' => 'phân biệt chủng tộc',
                'hint' => 'ray-sồ đi-s-c-rim-mi-nay-sần',
                'example' => 'Civil rights movement tried to end <strong>Racial discrimination</strong>.',
            ],
            [
                'word' => 'Representative',
                'meaning' => 'Dân biểu Hạ viện',
                'hint' => 're-prì-sen-đơ-đi-(v)',
                'example' => 'Name your U.S. <strong>Representative</strong>.',
            ],
            [
                'word' => 'Republican',
                'meaning' => 'Cộng hòa',
                'hint' => 'rì-pấp-li-cần',
                'example' => 'Democratic and <strong>Republican</strong> are the two major political parties in the United States.',
            ],
            [
                'word' => 'Responsibility',
                'meaning' => 'trách nhiệm, bổn phận',
                'hint' => 'rì-s-pon-sơ-bi-li-đi',
                'example' => 'What is one <strong>Responsibility</strong> that is only for United States citizens?',
            ],
            [
                'word' => 'Right/rights',
                'meaning' => 'quyền',
                'hint' => 'rai-(t) / rai-t-(s)',
                'example' => 'Name one <strong>Right</strong> only for United States citizens.',
            ],
            [
                'word' => 'Rule of law',
                'meaning' => 'thượng tôn pháp luật, luật trên hết',
                'hint' => 'ru ợp lo',
                'example' => 'What is the “<strong>Rule of law</strong>”?',
            ],
            [
                'word' => 'Selective Service',
                'meaning' => 'Sở Quân vụ',
                'hint' => 'sơ-léc-đi-(v) sơ-vịt-(s)',
                'example' => 'All men register for the <strong>Selective Service</strong> at age 18.',
            ],
            [
                'word' => 'Senate',
                'meaning' => 'Thượng viện',
                'hint' => 'sé-nẹt-(t)',
                'example' => 'The <strong>Senate</strong> and House of Representatives.',
            ],
            [
                'word' => 'Senator',
                'meaning' => 'Thượng nghị sĩ',
                'hint' => 'sé-ne-đờ',
                'example' => 'Who is one of your state’s U.S. Senators now?',
            ],
            [
                'word' => 'Show loyalty',
                'meaning' => 'thể hiện lòng trung thành',
                'hint' => 'sâu loi-ồ-đi',
                'example' => 'We <strong>Show loyalty</strong> to the United Sates when we say the Pledge of Allegiance.',
            ],
            [
                'word' => 'Sign bills',
                'meaning' => 'ký dự luật',
                'hint' => 'sai biu-(s)',
                'example' => 'The President signs bills to become laws.',
            ],
            [
                'word' => 'Slavery',
                'meaning' => 'nô lệ',
                'hint' => 's-lấy-vơ-ri',
                'example' => '<strong>Slavery</strong> was one problem that led to the Civil War.',
            ],
            [
                'word' => 'Slaves',
                'meaning' => 'nô lệ',
                'hint' => 's-lây-v-(s)',
                'example' => 'Africans were taken to America and sold as <strong>Slaves</strong>.',
            ],
            [
                'word' => 'South',
                'meaning' => 'miền Nam',
                'hint' => 'sao-(th)',
                'example' => 'Civil War is the U.S. war between the North and the <strong>South</strong>.',
            ],
            [
                'word' => 'Speaker of the House',
                'meaning' => 'Chủ tịch Hạ viện',
                'hint' => 's-pít-cơ ợp đờ hao-(s)',
                'example' => 'What is the name of the <strong>Speaker of the House</strong> of Representatives now?',
            ],
            [
                'word' => 'Star/stars',
                'meaning' => 'ngôi sao',
                'hint' => 's-ta / s-ta-(s)',
                'example' => 'The flag have 50 <strong>stars</strong> because there are 50 states.',
            ],
            [
                'word' => 'State/states',
                'meaning' => 'tiểu bang',
                'hint' => 's-tây-(t) / s-tây-t-(s)',
                'example' => 'The flag have 50 stars because there are 50 <strong>states</strong>.',
            ],
            [
                'word' => 'Statue of Liberty',
                'meaning' => 'Tượng Nữ thần Tự do',
                'hint' => 's-ta-tiu ợp li-bơ-đi',
                'example' => 'The <strong>Statue of Liberty</strong> is in New York Harbor.',
            ],
            [
                'word' => 'Stop',
                'meaning' => 'ngăn chặn, dừng',
                'hint' => 's-tóp-(p)',
                'example' => 'Checks and balances <strong>Stop</strong> one branch of government from becoming too powerful.',
            ],
            [
                'word' => 'Stripe/stripes',
                'meaning' => 'sọc',
                'hint' => 's-trai-(p) / s-trai-p-(s)',
                'example' => 'The flag have 13 <strong>stripes</strong> because there were 13 original colonies.',
            ],
            [
                'word' => 'Supreme Court',
                'meaning' => 'Tòa án Tối cao',
                'hint' => 'sờ-p-rim cót-(t)',
                'example' => 'The <strong>Supreme Court</strong> is the highest court in the United States.',
            ],
            [
                'word' => 'Supreme law',
                'meaning' => 'luật cao nhất',
                'hint' => 'sơ-p-rim lo',
                'example' => 'The Constitution the <strong>Supreme law</strong> of the land.',
            ],
            [
                'word' => 'Tax/taxes',
                'meaning' => 'thuế',
                'hint' => 'tác-(s) / tác-xịt-(s)',
                'example' => 'The colonists fight the British because of high <strong>taxes</strong>.',
            ],
            [
                'word' => 'Territory',
                'meaning' => 'lãnh thổ',
                'hint' => 'té-rơ-to-ri',
                'example' => 'Puerto Rico is one U.S. <strong>Territory</strong>.',
            ],
            [
                'word' => 'Terrorist/terrorists',
                'meaning' => 'bọn khủng bổ',
                'hint' => 'tê-rơ-rịt-(s)',
                'example' => '<strong>terrorists</strong> attacked the United States on September 11, 2001.',
            ],
            [
                'word' => 'The Star-Spangled Banner',
                'meaning' => 'tên bài quốc ca của Hoa Kỳ',
                'hint' => 'đờ s-ta s-pang-gồ-(d) ban-nờ',
                'example' => '<strong>The Star-Spangled Banner</strong> the name of the national anthem.',
            ],
            [
                'word' => 'Too powerful',
                'meaning' => 'quá quyền lực',
                'hint' => 'tu pao-quơ-phu-(l)',
                'example' => 'What stops one branch of government from becoming <strong>Too powerful</strong>?',
            ],
            [
                'word' => 'U.S. diplomat',
                'meaning' => 'nhà ngoại giao Mỹ',
                'hint' => 'diu-ét-(s) đíp-lơ-mat-(t)',
                'example' => 'Benjamin Franklin is a <strong>U.S. diplomat</strong>.',
            ],
            [
                'word' => 'U.S. territory',
                'meaning' => 'vùng lãnh thổ của Mỹ (nhưng không phải tiểu bang chính thức)',
                'hint' => 'diu-ét-(s) té-rơ-to-ri',
                'example' => 'Puerto Rico is one <strong>U.S. territory</strong>.',
            ],
            [
                'word' => 'United States citizen',
                'meaning' => 'công dân Mỹ',
                'hint' => 'diu-nai-tịc s-tây-(s) si-ti-giần',
                'example' => 'United States citizens can vote in a federal election.',
            ],
            [
                'word' => 'Veto bills',
                'meaning' => 'phủ quyết, bác bỏ dự luật',
                'hint' => 'vi-đâu biu-(s)',
                'example' => 'The President can <strong>Veto bills</strong>.',
            ],
            [
                'word' => 'Vice President',
                'meaning' => 'Phó Tổng thống',
                'hint' => 'vai-(s) p-ré-gi-đềnh-(t)',
                'example' => 'The President can no longer serve,  the <strong>Vice President</strong> can become President.',
            ],
            [
                'word' => 'Vote',
                'meaning' => 'bỏ phiếu',
                'hint' => 'vâu-(t)',
                'example' => 'We <strong>Vote</strong> for President in November.',
            ],
            [
                'word' => 'War',
                'meaning' => 'cuộc chiến, chiến tranh',
                'hint' => 'quo-(r)',
                'example' => 'Woodrow Wilson was President during World <strong>War</strong> I.',
            ],
            [
                'word' => 'We the People',
                'meaning' => 'Chúng ta Người dân',
                'hint' => 'qui đờ pi-pồ',
                'example' => '<strong>We the People</strong> are the first three words in the Constitution.',
            ],
            [
                'word' => 'West Coast',
                'meaning' => 'bờ Tây',
                'hint' => 'quét-s-(t) câu-s-(t)',
                'example' => 'Pacific Ocean is on the <strong>West Coast</strong> of the United States.',
            ],
            [
                'word' => 'What happened',
                'meaning' => 'chuyện gì đã xảy ra',
                'hint' => 'quát-(t) háp-pần-(d)',
                'example' => '<strong>What happened</strong> at the Constitutional Convention?',
            ],
            [
                'word' => 'What month',
                'meaning' => 'tháng mấy',
                'hint' => 'quát-(t) mân-(th)',
                'example' => 'In <strong>What month</strong> do we vote for President?',
            ],
            [
                'word' => 'What … do',
                'meaning' => 'làm gì',
                'hint' => 'quát-(t) đu',
                'example' => 'What did the Declaration of Independence do?',
            ],
            [
                'word' => 'When',
                'meaning' => 'khi nào',
                'hint' => 'quen',
                'example' => '<strong>When</strong> is the last day you can send in federal income tax forms?',
            ],
            [
                'word' => 'Who',
                'meaning' => 'ai',
                'hint' => 'hu',
                'example' => '<strong>Who</strong> is the Father of our Country?',
            ],
            [
                'word' => 'Who can vote',
                'meaning' => 'ai có quyền bỏ phiếu',
                'hint' => 'hu ken vâu-(t)',
                'example' => null,
            ],
            [
                'word' => 'White House',
                'meaning' => 'Nhà Trắng',
                'hint' => 'quai-(t) hao-(s)',
                'example' => 'Where is the <strong>White House</strong>?',
            ],
            [
                'word' => 'Women’s rights',
                'meaning' => 'quyền của phụ nữ',
                'hint' => 'qui-mần-(s) rai-(s)',
                'example' => 'Susan B. Anthony fought for <strong>Women’s rights</strong>.',
            ],
            [
                'word' => 'World War I',
                'meaning' => 'Thế chiến thứ nhất',
                'hint' => null,
                'example' => 'Woodrow Wilson was President during <strong>World War I</strong>.',
            ],
            [
                'word' => 'World War II',
                'meaning' => 'Thế chiến thứ hai',
                'hint' => null,
                'example' => 'Franklin Roosevelt was President during the Great Depression and <strong>World War II</strong>.',
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => '12 tháng',
            'slug' => '12-months'
        ]);

        $vocabularies = [
            [
                'word' => 'January',
                'meaning' => 'tháng 1',
                'hint' => 'chen-niu-e-ri',
                'example' => null,
            ],
            [
                'word' => 'February',
                'meaning' => 'tháng 2',
                'hint' => 'phép-ru-e-ri',
                'example' => null,
            ],
            [
                'word' => 'March',
                'meaning' => 'tháng 3',
                'hint' => 'ma-r-(ch)',
                'example' => null,
            ],
            [
                'word' => 'April',
                'meaning' => 'tháng 4',
                'hint' => 'ây-p-rồ',
                'example' => null,
            ],
            [
                'word' => 'May',
                'meaning' => 'tháng 5',
                'hint' => 'mây',
                'example' => null,
            ],
            [
                'word' => 'June',
                'meaning' => 'tháng 6',
                'hint' => 'chun',
                'example' => null,
            ],
            [
                'word' => 'July',
                'meaning' => 'tháng 7',
                'hint' => 'chơ-lai',
                'example' => null,
            ],
            [
                'word' => 'August',
                'meaning' => 'tháng 8',
                'hint' => 'ó-gợt-s-(t)',
                'example' => null,
            ],
            [
                'word' => 'September',
                'meaning' => 'tháng 9',
                'hint' => 'sẹp-tem-bờ',
                'example' => null,
            ],
            [
                'word' => 'October',
                'meaning' => 'tháng 10',
                'hint' => 'ọt-tô-bờ',
                'example' => null,
            ],
            [
                'word' => 'November',
                'meaning' => 'tháng 11',
                'hint' => 'nâu-vém-bờ',
                'example' => null,
            ],
            [
                'word' => 'December',
                'meaning' => 'tháng 12',
                'hint' => 'đì-xem-bờ',
                'example' => null,
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => 'Ngày lễ',
            'slug' => 'holidays'
        ]);

        $vocabularies = [
            [
                'word' => 'Christmas',
                'meaning' => 'Giáng sinh',
                'hint' => 'k-rít-mợt-(s)',
                'example' => '<strong>Christmas</strong> is a national U.S. holiday.',
            ],
            [
                'word' => 'Columbus Day',
                'meaning' => 'Ngày Columbus',
                'hint' => 'cơ-lấm-bợt-(s) đay',
                'example' => '<strong>Columbus Day</strong> is in October.',
            ],
            [
                'word' => 'Flag Day',
                'meaning' => 'Ngày Quốc kỳ',
                'hint' => 'ph-lat-(g) đay',
                'example' => '<strong>Flag Day</strong> is in June.',
            ],
            [
                'word' => 'Independence Day',
                'meaning' => 'Ngày Độc lập',
                'hint' => 'in-đì-pen-đần-(s) đay',
                'example' => '<strong>Independence Day</strong> is in July.',
            ],
            [
                'word' => 'Labor Day',
                'meaning' => 'Ngày Lao động',
                'hint' => 'lay-bờ đay',
                'example' => '<strong>Labor Day</strong> is in September.',
            ],
            [
                'word' => 'Martin Luther King, Jr. Day',
                'meaning' => 'Ngày Martin Luther King, Jr.',
                'hint' => 'ma-đin lu-đờ kin chu-ni-ờ',
                'example' => '<strong>Martin Luther King, Jr. Day</strong> is a national U.S. holiday.',
            ],
            [
                'word' => 'Memorial Day',
                'meaning' => 'Ngày Tưởng niệm',
                'hint' => 'mờ-mó-ri-ồ đay',
                'example' => '<strong>Memorial Day</strong> is in May.',
            ],
            [
                'word' => 'New Year’s Day',
                'meaning' => 'Tết Dương lịch',
                'hint' => 'niu dia-s đay',
                'example' => 'New Year\'s Day is in January.',
            ],
            [
                'word' => 'Presidents’ Day',
                'meaning' => 'Ngày Tổng thống',
                'hint' => 'p-ré-gi-đềnh-(s) đay',
                'example' => '<strong>Presidents’ Day</strong> is in February.',
            ],
            [
                'word' => 'Thanksgiving',
                'meaning' => 'Lễ Tạ ơn',
                'hint' => 'thanh-s-gi-vin',
                'example' => '<strong>Thanksgiving</strong> is in November.',
            ],
            [
                'word' => 'Veterans Day',
                'meaning' => 'Ngày Cựu chiến binh',
                'hint' => 'vét-đơ-rần-(s) đay',
                'example' => '<strong>Veterans Day</strong> is a national U.S. holiday.',
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => 'Tên riêng',
            'slug' => 'proper-nouns'
        ]);

        $vocabularies = [
            [
                'word' => 'George Washington',
                'meaning' => 'Tổng thống đầu tiên, Người Cha của Đất nước',
                'hint' => 'cho-(ch) qua-sing-tân',
                'example' => '<strong>George Washington</strong> is the Father of our Country.',
            ],
            [
                'word' => 'John Adams',
                'meaning' => 'Tổng thống thứ hai',
                'hint' => null,
                'example' => '<strong>John Adams</strong> was the second President.',
            ],
            [
                'word' => 'Thomas Jefferson',
                'meaning' => 'Tổng thống thứ 3, một trong những người viết Tuyên ngôn Độc lập.',
                'hint' => 'tho-mợt-(s) che-phơ-sần',
                'example' => '<strong>Thomas Jefferson</strong> wrote the Declaration of Independence',
            ],
            [
                'word' => 'Benjamin Franklin',
                'meaning' => 'nhà ngoại giao Mỹ',
                'hint' => 'ben-cha-min ph-răng-lin',
                'example' => '<strong>Benjamin Franklin</strong> is a U.S. diplomat.',
            ],
            [
                'word' => 'Abraham Lincoln',
                'meaning' => 'Tổng thống thứ 16, người lãnh đạo nội chiến, giải phóng nô lệ',
                'hint' => 'ây-brơ-ham lin-cần',
                'example' => '<strong>Abraham Lincoln</strong> freed the slaves.',
            ],
            [
                'word' => 'Woodrow Wilson',
                'meaning' => 'Tổng thống Mỹ trong Thế chiến thứ nhất',
                'hint' => 'wu-râu quiu-sân',
                'example' => '<strong>Woodrow Wilson</strong> was President during World War I.',
            ],
            [
                'word' => 'Franklin Roosevelt',
                'meaning' => 'Tổng thống Mỹ trong Thế chiến thứ hai',
                'hint' => 'ph-răng-k-lin râu-giơ-veo-(t)',
                'example' => '<strong>Franklin Roosevelt</strong> was President during the Great Depression and World War II.',
            ],
            [
                'word' => 'Eisenhower',
                'meaning' => 'Tổng thống Mỹ trong Thế chiến thứ 2',
                'hint' => 'ai-sần-hao-ờ',
                'example' => 'Before he was President, <strong>Eisenhower</strong> was a general in World War II.',
            ],
            [
                'word' => 'Donald Trump',
                'meaning' => 'Tổng thống thứ 45 và 47',
                'hint' => 'đo-nồ trâm',
                'example' => '<strong>Donald Trump</strong> is the President of the United States now.',
            ],
            [
                'word' => 'JD Vance',
                'meaning' => 'Phó Tổng thống thứ 50',
                'hint' => 'chây đi van-(s)',
                'example' => '<strong>JD Vance</strong> is the Vice President now.',
            ],
            [
                'word' => 'John Roberts',
                'meaning' => 'Chánh án thứ 17',
                'hint' => 'chon ro-bợt-(s)',
                'example' => '<strong>John Roberts</strong> is the Chief Justice of the United States.',
            ],
            [
                'word' => 'Mike Johnson',
                'meaning' => 'Chủ tịch Hạ viện kể từ năm 2023',
                'hint' => 'mai-(k) chon-sần',
                'example' => '<strong>Mike Johnson</strong> is the name of the Speaker of the House of Representatives now.',
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => '50 bang',
            'slug' => '50-states'
        ]);

        $vocabularies = [
            [
                'word' => 'New Hampshire',
                'meaning' => 'niu ham-sờ',
                'hint' => 'niu ham-sờ',
                'example' => null,
            ],
            [
                'word' => 'Massachusetts',
                'meaning' => 'ma-sờ-chu-sịt-(s)',
                'hint' => 'ma-sờ-chu-sịt-(s)',
                'example' => null,
            ],
            [
                'word' => 'Rhode Island',
                'meaning' => 'râu-(d) ai-lần-(d)',
                'hint' => 'râu-(d) ai-lần-(d)',
                'example' => null,
            ],
            [
                'word' => 'Connecticut',
                'meaning' => 'cờ-ne-đi-cợt-(t)',
                'hint' => 'cờ-ne-đi-cợt-(t)',
                'example' => null,
            ],
            [
                'word' => 'New York',
                'meaning' => 'niu dót-(k)',
                'hint' => 'niu dót-(k)',
                'example' => null,
            ],
            [
                'word' => 'New Jersey',
                'meaning' => 'niu chơ-si',
                'hint' => 'niu chơ-si',
                'example' => null,
            ],
            [
                'word' => 'Pennsylvania',
                'meaning' => 'pen-sồ-vay-ni-ờ',
                'hint' => 'pen-sồ-vay-ni-ờ',
                'example' => null,
            ],
            [
                'word' => 'Delaware',
                'meaning' => 'đe-lờ-que',
                'hint' => 'đe-lờ-que',
                'example' => null,
            ],
            [
                'word' => 'Maryland',
                'meaning' => 'mé-rơ-lần-(d)',
                'hint' => 'mé-rơ-lần-(d)',
                'example' => null,
            ],
            [
                'word' => 'Virginia',
                'meaning' => 'vơ-gin-ni-ờ',
                'hint' => 'vơ-gin-ni-ờ',
                'example' => null,
            ],
            [
                'word' => 'North Carolina',
                'meaning' => 'no-(th) ca-rô-lai-nà',
                'hint' => 'no-(th) ca-rô-lai-nà',
                'example' => null,
            ],
            [
                'word' => 'South Carolina',
                'meaning' => 'sao-(th) ca-rô-lai-nà',
                'hint' => 'sao-(th) ca-rô-lai-nà',
                'example' => null,
            ],
            [
                'word' => 'Georgia',
                'meaning' => 'cho-chờ',
                'hint' => 'cho-chờ',
                'example' => null,
            ],
            [
                'word' => 'Alabama',
                'meaning' => 'a-lơ-ba-mà',
                'hint' => 'a-lơ-ba-mà',
                'example' => null,
            ],
            [
                'word' => 'Alaska',
                'meaning' => 'ờ-lát-s-ca',
                'hint' => 'ờ-lát-s-ca',
                'example' => null,
            ],
            [
                'word' => 'Arizona',
                'meaning' => 'e-ri-giốn-nà',
                'hint' => 'e-ri-giốn-nà',
                'example' => null,
            ],
            [
                'word' => 'Arkansas',
                'meaning' => 'a-cân-sa',
                'hint' => 'a-cân-sa',
                'example' => null,
            ],
            [
                'word' => 'California',
                'meaning' => 'ca-li-pho-nhờ',
                'hint' => 'ca-li-pho-nhờ',
                'example' => null,
            ],
            [
                'word' => 'Colorado',
                'meaning' => 'cơ-lờ-ra-đồ',
                'hint' => null,
                'example' => null,
            ],
            [
                'word' => 'Florida',
                'meaning' => 'ph-lo-ri-đờ',
                'hint' => 'ph-lo-ri-đờ',
                'example' => null,
            ],
            [
                'word' => 'Hawaii',
                'meaning' => 'hơ-quai-i',
                'hint' => 'hơ-quai-i',
                'example' => null,
            ],
            [
                'word' => 'Idaho',
                'meaning' => 'ai-đa-hâu',
                'hint' => 'ai-đa-hâu',
                'example' => null,
            ],
            [
                'word' => 'Illinois',
                'meaning' => 'i-li-noi',
                'hint' => 'i-li-noi',
                'example' => null,
            ],
            [
                'word' => 'Indiana',
                'meaning' => 'in-đi-an-nà',
                'hint' => 'in-đi-an-nà',
                'example' => null,
            ],
            [
                'word' => 'Iowa',
                'meaning' => 'ai-ờ-qua',
                'hint' => 'ai-ờ-qua',
                'example' => null,
            ],
            [
                'word' => 'Kansas',
                'meaning' => 'can-giợt-(s)',
                'hint' => 'can-giợt-(s)',
                'example' => null,
            ],
            [
                'word' => 'Kentucky',
                'meaning' => 'ken-tất-ki',
                'hint' => 'ken-tất-ki',
                'example' => null,
            ],
            [
                'word' => 'Louisiana',
                'meaning' => 'lu-i-si-an-na',
                'hint' => 'lu-i-si-an-na',
                'example' => null,
            ],
            [
                'word' => 'Maine',
                'meaning' => 'man',
                'hint' => 'man',
                'example' => null,
            ],
            [
                'word' => 'Michigan',
                'meaning' => 'mi-si-gân',
                'hint' => 'mi-si-gân',
                'example' => null,
            ],
            [
                'word' => 'Minnesota',
                'meaning' => 'mi-ni-sâu-đà',
                'hint' => 'mi-ni-sâu-đà',
                'example' => null,
            ],
            [
                'word' => 'Mississippi',
                'meaning' => 'mi-si-si-pi',
                'hint' => 'mi-si-si-pi',
                'example' => null,
            ],
            [
                'word' => 'Missouri',
                'meaning' => 'mi-giua-ri',
                'hint' => 'mi-giua-ri',
                'example' => null,
            ],
            [
                'word' => 'Montana',
                'meaning' => 'mon-tá-nơ',
                'hint' => 'mon-tá-nơ',
                'example' => null,
            ],
            [
                'word' => 'Nebraska',
                'meaning' => 'nờ-b-rát-s-ka',
                'hint' => 'nờ-b-rát-s-ka',
                'example' => null,
            ],
            [
                'word' => 'Nevada',
                'meaning' => 'nờ-va-đà',
                'hint' => 'nờ-va-đà',
                'example' => null,
            ],
            [
                'word' => 'New Mexico',
                'meaning' => 'niu me-xi-cô',
                'hint' => 'niu me-xi-cô',
                'example' => null,
            ],
            [
                'word' => 'North Dakota',
                'meaning' => 'no-(th) đờ-câu-đà',
                'hint' => 'no-(th) đờ-câu-đà',
                'example' => null,
            ],
            [
                'word' => 'Ohio',
                'meaning' => 'âu-hai-âu',
                'hint' => 'âu-hai-âu',
                'example' => null,
            ],
            [
                'word' => 'Oklahoma',
                'meaning' => 'âu-k-lờ-hâu-mờ',
                'hint' => 'âu-k-lờ-hâu-mờ',
                'example' => null,
            ],
            [
                'word' => 'Oregon',
                'meaning' => 'o-ri-gần',
                'hint' => 'o-ri-gần',
                'example' => null,
            ],
            [
                'word' => 'South Dakota',
                'meaning' => 'sao-(th) đờ-câu-đờ',
                'hint' => 'sao-(th) đờ-câu-đờ',
                'example' => null,
            ],
            [
                'word' => 'Tennessee',
                'meaning' => 'ten-nờ-si',
                'hint' => 'ten-nờ-si',
                'example' => null,
            ],
            [
                'word' => 'Texas',
                'meaning' => 'tét-xợt-(s)',
                'hint' => 'tét-xợt-(s)',
                'example' => null,
            ],
            [
                'word' => 'Utah',
                'meaning' => 'diu-ta',
                'hint' => 'diu-ta',
                'example' => null,
            ],
            [
                'word' => 'Vermont',
                'meaning' => 'vơ-mon-(t)',
                'hint' => 'vơ-mon-(t)',
                'example' => null,
            ],
            [
                'word' => 'Washington',
                'meaning' => 'qua-sing-tân',
                'hint' => 'qua-sing-tân',
                'example' => null,
            ],
            [
                'word' => 'West Virginia',
                'meaning' => 'quét-(s) vờ-chin-nhờ',
                'hint' => 'quét-(s) vờ-chin-nhờ',
                'example' => null,
            ],
            [
                'word' => 'Wisconsin',
                'meaning' => 'qui-s-cón-sin',
                'hint' => 'qui-s-cón-sin',
                'example' => null,
            ],
            [
                'word' => 'Wyoming',
                'meaning' => 'quai-âu-ming',
                'hint' => 'quai-âu-ming',
                'example' => null,
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $category = VocabularyCategory::firstOrCreate([
            'topic_id' => $topic->id,
            'name' => 'Số',
            'slug' => 'number'
        ]);

        $vocabularies = [
            [
                'word' => 'Eighteen',
                'meaning' => '18',
                'hint' => 'ây-tin',
                'example' => 'To vote for President, citizens must be 18 or older.',
            ],
            [
                'word' => 'Twenty-seven',
                'meaning' => '27',
                'hint' => 'troen-đi se-vần',
                'example' => 'The Constitution have 27 amendments.',
            ],
            [
                'word' => 'Fifty',
                'meaning' => '50',
                'hint' => 'phíp-đi',
                'example' => 'The United States has 50 states.',
            ],
            [
                'word' => 'One hundred',
                'meaning' => '100',
                'hint' => 'quan hênh-rệt-(d)',
                'example' => 'There are 100 U.S. Senators.',
            ],
            [
                'word' => 'Four hundred thirty-five',
                'meaning' => '435',
                'hint' => 'pho hênh-rệt-(d) thơ-đi-phai-(v)',
                'example' => 'There are 435 voting members in the House of Representatives.',
            ],
            [
                'word' => 'First',
                'meaning' => 'đầu tiên',
                'hint' => 'phớt-(s)',
                'example' => 'Washington is the <strong>First</strong> president.',
            ],
            [
                'word' => 'Second',
                'meaning' => 'thứ hai',
                'hint' => null,
                'example' => 'Who was the <strong>Second</strong> president?',
            ],
            [
                'word' => 'Seventeen seventy-six',
                'meaning' => '1776',
                'hint' => 'se-vần-tin se-vần-đi sít-(s)',
                'example' => 'The Declaration of Independence was adopted on July 4, 1776.',
            ],
            [
                'word' => 'Seventeen eighty-seven',
                'meaning' => '1787',
                'hint' => null,
                'example' => 'The Constitution was written in 1787.',
            ],
            [
                'word' => 'Eighteen oh three',
                'meaning' => '1803',
                'hint' => 'ây-tin âu th-ri',
                'example' => 'The United States bought Louisiana from France 1803.',
            ],
            [
                'word' => 'The 1800s',
                'meaning' => 'những năm 1800',
                'hint' => 'đì ây-tin hênh-rệt-(s)',
                'example' => 'The United States fought in the Civil War in <strong>The 1800s</strong>.',
            ],
            [
                'word' => 'The 1900s',
                'meaning' => 'những năm 1900',
                'hint' => 'đờ nai-tin-(s)',
                'example' => 'The United States fought in the Vietnam War in the 1900s.',
            ],
        ];

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'category_id' => $category->id,
                'word' => $vocab['word'],
                'meaning' => $vocab['meaning'],
                'hint' => $vocab['hint'],
                'example' => $vocab['example'],
            ]);
        }

        $this->call(VocabularyN400Seeder::class);
    }
}
