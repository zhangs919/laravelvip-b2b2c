<?php


namespace App\Modules\Frontend\Http\Controllers;


use App\Kernel\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class OpenaiController extends Frontend
{


	public function chatGpt(Request $request)
	{
		$open_ai_key = config('lrw.openai_api_key');
		$open_ai = new OpenAi($open_ai_key);
		$params = $request->post('form');
		$msg = $params['msg'];

		$complete = $open_ai->chat([
			'model' => 'gpt-3.5-turbo',
//			'messages' => [
//				[
//					"role" => "system",
//					"content" => "You are a helpful assistant."
//				],
//				[
//					"role" => "user",
//					"content" => "Who won the world series in 2020?"
//				],
//				[
//					"role" => "assistant",
//					"content" => "The Los Angeles Dodgers won the World Series in 2020."
//				],
//				[
//					"role" => "user",
//					"content" => "Where was it played?"
//				],
//			],
			'messages' => [
				[
					"role" => "user",
					"content" => $msg
				],
			],
			'temperature' => 1.0,
			'max_tokens' => 1200,
			'frequency_penalty' => 0,
			'presence_penalty' => 0,
		]);

		$result = json_decode($complete, true);
		$message = $result['choices'][0]['message'] ?? '';
		return result(0, $message, '请求成功');
	}
}
