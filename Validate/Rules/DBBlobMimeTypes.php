<?php
/**
 * Accepted file types when storing files to the database.
 * I personally would recommend storing files on your server
 * or in the cloud someplace else.
 * Storing files in the database can cause issues with performance.
 */
return [
	//Text Files
	'text/plain', // – Plain text
	'text/html', // – HTML file
	'text/css', // – CSS stylesheet
	'text/javascript', // – JavaScript file

	//Image Files
	'image/jpeg', // – JPEG images
	'image/png', // – PNG images
	'image/gif', // – GIF images
	'image/webp', // – WEBP images
	'image/svg+xml', // – SVG graphics

	//Audio Files
	'audio/mpeg', // – MP3 audio
	'audio/wav', // – WAV audio
	'audio/ogg', // – OGG audio

	//Video Files
	'video/mp4', // – MP4 video
	'video/x-msvideo', // – AVI video
	'video/mpeg', // – MPEG video
	'video/webm', // – WEBM video

	//Application Files
	'application/pdf', // – PDF documents
	'application/zip', // – ZIP archive
	'application/msword', // – Microsoft Word documents
	'application/vnd.ms-excel', // – Microsoft Excel documents
	'application/x-7z-compressed', // – 7z archive
	'application/x-rar-compressed', // – RAR archive
	'application/vnd.ms-powerpoint', // – Microsoft PowerPoint
	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // – Microsoft Excel (OpenXML)
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // – Microsoft Word (OpenXML)
	'application/vnd.openxmlformats-officedocument.presentationml.presentation', // – Microsoft PowerPoint (OpenXML)

	//JSON and XML
	'application/json – JSON format',
	'application/xml – XML format',

	//Executable Files
	//'application/x-msdownload – EXE files',
	//'application/x-sh – Shell script',

	//Miscellaneous
	//'application/octet-stream' // – Binary data or files where the type is not known

];